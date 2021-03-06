<?php

namespace App\Http\Controllers;

use App\AnnouncementComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\Subject;
use App\Group;
use App\StudentsGroup;
use App\User;
use App\SubjectEnrollment;
use App\Announcement;
use Storage;
use Carbon\Carbon;
use App\Documentation;
use App\File;
use App\Evaluation;
use Auth;
use DB;
class ProfessorProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->option=="project") {
            $this->validate($request, [
                'title' => 'required',
                'deadline' => 'required',
                'group_formation_deadline' => 'required',
                'minNumber' => 'integer|lte:maxNumber',
                'maxNumber' => 'integer',
                'maxGrade' => 'required'
            ],[
                'title.required' => trans('gx.titleReq'),
                'deadline.required' => trans('gx.deadlineReq'),
                'group_formation_deadline.required' => trans('gx.groupdeadlineReq'),
                'minNumber.lte' => trans('gx.minNumberReq')
            ]);

            $project = new Project;
            $project->name = $request->title;
            $project->dueDate = Carbon::parse($request->deadline);
            $project->groupCreationDueDate = Carbon::parse($request->group_formation_deadline);
            $project->minElements = $request->minNumber;
            $project->maxElements = $request->maxNumber;
            $project->maxGrade = $request->maxGrade;
            $project->idSubject = $request->subject;
            $project->maxGroups = SubjectEnrollment::all()->where('idSubject', '==', $request->subject)->count();
            $project->save();

            $files = $request->documentation;
            if ($files != null) {
                foreach ($files as $file) {
                    $doc = new Documentation;
                    $doc->idProject = $project->idProject;
                    $doc->pathfile = $file->getClientOriginalName();
                    $file = $file;
                    $doc->save();
                    $file->storeAs('documentation/' . $project->idProject, $doc->pathfile, 'gcs');
                }
            }

            $my_id = Auth::id();

            $project_ = DB::table('projects')->where('idProject', '=', $project->idProject)->value('idSubject');

            $enrollm = SubjectEnrollment::all()->where('idSubject','=',$project_)->pluck('idUser');

            $project_name = DB::table('projects')->where('idProject', '=', $project->idProject)->value('name');

            $subject = DB::table('subjects')->where('idSubject', '=', $project_)->value('subjectName');

            if($enrollm->count() > 0){
                foreach ($enrollm as $u){
                    $users = User::all()->where('id', '=', $u)->where('id', '!=', $my_id);
                    foreach ($users as $user){
                        $user->notify(new \App\Notifications\InvoicePaid($my_id,trans('gx.created'), $project->idProject ,$project_name,$subject));
                    }
                }
            }

            return redirect('/')->with('success', trans('gx.projectCreated'));

        } elseif ($request->option=="projectFiles"){
            $this->validate($request, [
                [
                    'documentation.required' => trans('gx.documentationReq'),
                ]
            ]);

            $files = $request->documentation;
            $successFile = [];
            $errorFile = [];

            foreach ($files as $file) {
                $existFile = ['idProject' =>  $request->project, 'pathFile' => $file->getClientOriginalName()];
                if (count(Documentation::where($existFile)->get()) != 0) {
                    array_push($errorFile, $file->getClientOriginalName());
                } else {
                    array_push($successFile, $file->getClientOriginalName());
                    $doc = new Documentation;
                    $doc->idProject = $request->project;
                    $doc->pathfile = $file->getClientOriginalName();
                    $file = $file;
                    $doc->save();
                    $file->storeAs('documentation/' . $request->project, $doc->pathfile, 'gcs');
                }
            }


            $my_id = Auth::id();

            $project_ = DB::table('projects')->where('idProject', '=', $request->project)->value('idSubject');

            $enrollm = SubjectEnrollment::all()->where('idSubject','=',$project_)->pluck('idUser');

            $project_name = DB::table('projects')->where('idProject', '=', $request->project)->value('name');

            $subject = DB::table('subjects')->where('idSubject', '=', $project_)->value('subjectName');

            if($enrollm->count() > 0){
                foreach ($enrollm as $u){
                    $users = User::all()->where('id', '=', $u)->where('id', '!=', $my_id);
                    foreach ($users as $user){
                        $user->notify(new \App\Notifications\InvoicePaid($my_id,trans('gx.uploadedFileN'), $request->project ,$project_name,$subject));
                    }
                }
            }
            if (!empty($successFile) and !empty($errorFile)){
                return redirect('professor/project/'. $request->project. '#characteristics')->with('success', trans('gx.fileUploadedM', ['file' => implode(", ",$successFile)]))->with('error', trans('gx.fileUploadedMError', ['file' => implode(", ",$errorFile)]));
            } elseif (empty($successFile) and !empty($errorFile)){
                return redirect('professor/project/'. $request->project. '#characteristics')->with('error', trans('gx.fileUploadedMError', ['file' => implode(", ",$errorFile)]));
            } elseif (!empty($successFile) and empty($errorFile)){
                return redirect('professor/project/'. $request->project. '#characteristics')->with('success', trans('gx.fileUploadedM', ['file' => implode(", ",$successFile)]));
            }

        }
        else {
            $this->validate($request, [
                'grade' => 'required'
            ]);

            $projectId = $request->project;
            $group = Group::find($request->group);
            $group->grade = $request->grade;
            $group->gradeComment = $request->gradeComment;
            $group->save();

            $my_id = Auth::id();

            $groups = DB::table('groups')->where('idProject', '=', $projectId)->value('idGroup');;
            $stuGroups = StudentsGroup::all()->where('idGroup', '=', $groups)->pluck("idStudent");
            $project = DB::table('projects')->where('idProject', '=', $projectId)->value('idSubject');
            $project_name = DB::table('projects')->where('idProject', '=', $projectId)->value('name');

            $subject = DB::table('subjects')->where('idSubject', '=', $project)->value('subjectName');
            if($stuGroups->count() > 0) {

                foreach ($stuGroups as $stu) {
                    $users = User::all()->where('id', '=', $stu)->where('id', '!=', $my_id);

                    foreach ($users as $user) {

                        $user->notify(new \App\Notifications\InvoicePaid($my_id, trans('gx.gradeGiven'), $projectId ,$project_name, $subject));

                    }

                }
            }


            return redirect('professor/project/'. $request->project. '#gr.pills-'.$group->idGroupProject)->with('success', trans('gx.gradeGiven'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);

        if ($project != null) {
            $belongsProj = ['idSubject' => $project->idSubject, 'idUser' => Auth::user()->id];

            if (Auth::user()->role == "student" or count(SubjectEnrollment::where($belongsProj)->get()) == 0) {
                abort('403');
            }

            $rep1 = DB::table('documentations')->where('idProject', $id)->orderBy('pathFile', 'ASC')->get();
            $rep2 = DB::table('files')->where('finalState', 'final')->orderBy('submissionTime', 'DESC')->get();

            $subject = Subject::find($project->idSubject);
            $groups = DB::table('groups')->where('idProject', $id)->orderBy('idGroupProject', 'ASC')->get();

            $announcements = Announcement::orderByDesc('date')->where('idProject', $id)->paginate(10)->fragment('forum');
            $allAnnouncements = [];
            foreach ($announcements as $a) {
                array_push($allAnnouncements, $a);
            }
            $userId = $announcements->pluck('sender');
            $users = [];
            foreach ($userId as $uId) {
                $user = User::find($uId);
                array_push($users, $user);
            }
            $idAnnouncement = $announcements->pluck('idAnnouncement');
            $numberComments = [];
            foreach ($idAnnouncement as $idA) {
                $idComment = AnnouncementComment::all()->where('idAnnouncement', '==', $idA)->count();
                array_push($numberComments, $idComment);
            }


            return view('professor.project')->with('numberComments', $numberComments)->with('project', $project)->with('subject', $subject)->with('groups', $groups)->with('announcements', $allAnnouncements)->with('userPoster', $users)->with('numberComments', $numberComments)->with('a', $announcements)->with('rep1', $rep1)->with('rep2', $rep2);

        }else{
            abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->option=="project") {
            $this->validate($request, [
                'title' => 'required',
                'minNumber' => 'integer|lte:maxNumber',
                'maxNumber' => 'integer'
            ],[
                'title.required' => trans('gx.titleReq'),
                'minNumber.lte' => trans('gx.minNumberReq')
            ]);

            $project = Project::find($id);
            $project->name = $request->title;
            if (!empty($request->deadline)){
                $project->dueDate = Carbon::parse($request->deadline);
            }else{
                $project->dueDate = $project->dueDate;
            }
            if (!empty($request->group_formation_deadline)){
                $project->groupCreationDueDate = Carbon::parse($request->group_formation_deadline);
            }else{
                $project->groupCreationDueDate = $project->groupCreationDueDate;
            }
            $project->minElements = $request->minNumber;
            $project->maxElements = $request->maxNumber;
            $project->idSubject = $project->idSubject;
            $project->maxGrade = $request->maxGrade;

            $project->maxGroups = SubjectEnrollment::all()->where('idSubject', '==', $request->subject)->count();
            $project->save();

            return redirect('professor/project/'. $id. '#characteristics')->with('success', trans('gx.projectUpdated'));

        } else {
            $this->validate($request, [
                'grade' => 'required'
            ],[
                'grade.required' => trans('gx.gradeReq'),

            ]);

            $group = Group::find($request->group);
            $group->grade = $request->grade;
            $group->gradeComment = $request->gradeComment;
            $group->save();

            return redirect('professor/project/'. $id. '#gr.pills-'.$group->idGroupProject)->with('success', trans('gx.gradeUpd'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){

        if($request->option == "doc"){
            $idDoc = $request->input('idDoc');
            $doc = Documentation::find($idDoc);
            Storage::delete('Documentation/'.$id.'/'.$doc->pathFile);
            $doc->delete();
            return redirect('professor/project/'. $id. '#characteristics')->with('success', trans('gx.docDeleted'));

        }else{
            $project = Project::find($id);
            Storage::delete('documentation/'.$project->idProject."/".$project->documentation);
            $project->delete();
            return redirect('/')->with('success', trans('gx.projectDeleted'));
        }

    }
}
