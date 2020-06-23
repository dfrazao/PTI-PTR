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
/*    public function index()
    {
        return view('professor.project');
    }*/

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
                'documentation' => 'required',
                'minNumber' => 'integer|lte:maxNumber',
                'maxNumber' => 'integer'
            ]);

            $project = new Project;
            $project->name = $request->title;
            $project->dueDate = Carbon::parse($request->deadline);
            $project->groupCreationDueDate = Carbon::parse($request->group_formation_deadline);
            $project->minElements = $request->minNumber;
            $project->maxElements = $request->maxNumber;
            $project->idSubject = $request->subject;
            $project->maxGroups = SubjectEnrollment::all()->where('idSubject', '==', $request->subject)->count();
            $project->save();

            $files = $request->documentation;
            foreach ($files as $file) {
                $doc = new Documentation;
                $doc->idProject = $project->idProject;
                $doc->pathfile = $file->getClientOriginalName();
                $file = $file;
                $doc->save();
                $file->storeAs('documentation/'.$project->idProject, $doc->pathfile, 'gcs');
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
                        $user->notify(new \App\Notifications\InvoicePaid($my_id,"Created", $project->idProject ,$project_name,$subject));
                    }
                }
            }

            return redirect('/')->with('success', 'Project Created');

        } elseif ($request->option=="projectFiles"){
            $this->validate($request, [
                'documentation' => 'required'
            ]);

            $doc = new Documentation;
            $doc->idProject = $request->project;
            $doc->pathfile = $request->file('documentation')->getClientOriginalName();
            $zip = $request->file('documentation');
            $doc->save();
            $zip->storeAs('documentation/'.$request->project, $doc->pathfile, 'gcs');

            $my_id = Auth::id();

            $project_ = DB::table('projects')->where('idProject', '=', $request->project)->value('idSubject');

            $enrollm = SubjectEnrollment::all()->where('idSubject','=',$project_)->pluck('idUser');

            $project_name = DB::table('projects')->where('idProject', '=', $request->project)->value('name');

            $subject = DB::table('subjects')->where('idSubject', '=', $project_)->value('subjectName');

            if($enrollm->count() > 0){
                foreach ($enrollm as $u){
                    $users = User::all()->where('id', '=', $u)->where('id', '!=', $my_id);
                    foreach ($users as $user){
                        $user->notify(new \App\Notifications\InvoicePaid($my_id,"Uploaded a file to documentation", $request->project ,$project_name,$subject));
                    }
                }
            }

            return redirect('professor/project/'. $request->project. '#characteristics')->with('success', 'File Uploaded');

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

            return redirect('professor/project/'. $request->project. '#gr.pills-'.$group->idGroupProject)->with('success', 'Grade Given');
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
        $rep1 = Documentation::all()->where('idProject', '==', $id);
        $rep2 = File::all()->where('finalState', '==', 'final');

        $project = Project::find($id);
        $subject = Subject::find($project->idSubject);
        $groups = Group::all()->where('idProject', '==', $id);

        $announcements = Announcement::orderBy('date', 'desc')->paginate(10)->fragment('forum');
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

        return view('professor.project')->with('numberComments', $numberComments)->with('project' , $project)->with('subject', $subject)->with('groups', $groups)->with('announcements', $allAnnouncements)->with('userPoster', $users)->with('numberComments', $numberComments)->with('a',$announcements)->with('rep1', $rep1)->with('rep2', $rep2);
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
            /*if( $request->file('documentation') ) {
                Storage::delete('documentation/'.$project->idProject."/".$project->documentation);
                $file = $request->file('documentation');
                $filename = $request->documentation->getClientOriginalName();
                $file->storeAs('documentation/'.$project->idProject, $filename, 'gcs');
                $project->documentation = $filename;
            }*/

            $project->maxGroups = SubjectEnrollment::all()->where('idSubject', '==', $request->subject)->count();
            $project->save();

            return redirect('professor/project/'. $id. '#characteristics')->with('success', 'Project Updated');

        } else {
            $this->validate($request, [
                'grade' => 'required'
            ]);

            $group = Group::find($request->group);
            $group->grade = $request->grade;
            $group->gradeComment = $request->gradeComment;
            $group->save();

            return redirect('professor/project/'. $id. '#gr.pills-'.$group->idGroupProject)->with('success', 'Grade Updated');
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
            return redirect('professor/project/'. $id. '#characteristics')->with('success', 'Doc deleted successfully');

        }else{
            $project = Project::find($id);
            Storage::delete('documentation/'.$project->idProject."/".$project->documentation);
            $project->delete();
            return redirect('/')->with('success', 'Project Deleted');
        }

    }
}
