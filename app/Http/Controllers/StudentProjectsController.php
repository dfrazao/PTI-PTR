<?php

namespace App\Http\Controllers;

use App\Availability;
use App\Http\Controllers\Controller;
use App\Meeting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Project;
use App\Subject;
use App\Announcement;
use App\AnnouncementComment;
use App\User;
use Auth;
use App\Group;
use App\StudentsGroup;
use App\Task;
use App\File;
use Storage;

class StudentProjectsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Request::ajax()) {
            $data = Input::all();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $submission = $request->input('submission');
        $idGroup = $request->input('group');
        $idProject = $request ->input('project');
        $user = Auth::user()->id;
        if($submission == "notes") {
            $this->validate($request, [
                'notes' => 'required'
            ]);
            $group = Group::find($idGroup);
            $group->notes = $request->input('notes');
            $group->save();

        } elseif($submission == "task"){
            $this->validate($request, [
                'description' => 'required',
                'responsible' => 'required',
                'beginning' => 'required'
            ]);
            $task = new Task;
            $task-> idGroup = $request ->input('group');
            $task-> description = $request->input('description');
            $task-> responsible = $request->input('responsible');
            $task-> beginning = Carbon::parse($request->input('beginning'));
            $task->save();

            return redirect()->action('StudentProjectsController@show', $idProject)->with('success', 'Task created successfully');
        }
        elseif($submission == "schedule"){
            $group = $request->input('group');
            $student = $request->input('idStudent');
            $id = Availability::where("idGroup", $group)->where("member", $student)->pluck("id")->first();
            if(!is_null(Availability::find($id))){
                if(($request->option) == 'add') {
                    $availability = Availability::find($id);
                    $currentAv = json_decode($availability->periods);
                    array_push($currentAv, $request->input('cell'));
                    $availability->periods = json_encode($currentAv);
                    $availability->save();
                }
                else{
                    $availability = Availability::find($id);
                    $currentAv = json_decode($availability->periods);
                    $key = array_search($request->cell, $currentAv);
                    array_splice($currentAv,$key);
                    $availability->periods = json_encode($currentAv);
                    $availability->save();
                }

            }
            else {
                $availability = new Availability;
                $availability -> idGroup = $group;
                $availability -> member = $student;
                $availability -> periods = json_encode([]);
                $availability -> color = $request -> color;
                $availability->save();
            }

        }
        elseif($submission == "newFile"){
            $this->validate($request, [
                'file' => 'required'
            ]);
            $file = new File;
            $file-> idGroup = $request ->input('group');
            $zip = $request->file('file');
            $file-> Pathfile = $request->file->getClientOriginalName();
            $file->finalState = "temporary";
            $file->save();
            $zip->storeAs('studentRepository/'.$idGroup, $file-> Pathfile, 'gcs');

            return redirect()->action('StudentProjectsController@show', $idProject)->with('success', 'File added successfully');
        }
        elseif($submission == 'submitFile'){
            dd($request->input('filesSubmit'));
        }
        else{
            $this->validate($request, [
                'description' => 'required',
                'place' => 'required',
                'date' => 'required'
            ]);
            $meeting = new Meeting;
            $meeting -> idGroup = $request->input('group');
            $meeting -> description = $request->input('description');
            $meeting -> date = Carbon::parse($request->input('date'));
            $meeting -> place = $request->input('place');

            $meeting->save();
            return redirect()->action('StudentProjectsController@show', $idProject)->with('success', 'Meeting created successfully');
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
        $user = Auth::user()->id;
        $project = Project::find($id);
        $subject = Subject::find($project->idSubject);
        $idGroups = Group::all()->where('idProject', '==', $id)->pluck('idGroup');
        $studentGroups = StudentsGroup::all()->where('idStudent', '==', $user)->pluck('idGroup');
        $idGroup = 0;
        foreach($studentGroups as $st)
            foreach ($idGroups as $g)
                if ($g == $st)
                    $idGroup = $g;

        // repository
        $rep = File::all()->where('idGroup', '==', $idGroup);

        // Tasks
        $arr = Task::all()->where('idGroup', '==', $idGroup);
        if(count($arr)>0){
            foreach ($arr as $task){
                $local = Carbon::getLocale();
                if($local == 'pt') {
                    Carbon::setLocale('en');
                }
                $task->beginning = Carbon::parse($task->beginning)->isoFormat('MMMM Do YYYY, h:mm a');
                if(!is_null($task->end)){
                    $task->end = Carbon::parse($task->end)->isoFormat('MMMM Do YYYY, h:mm a');
                    if(Carbon::parse($task->beginning)->diffInDays(Carbon::parse($task->end)) == 0) {
                        $task->duration = Carbon::parse($task->beginning)->addSeconds($task->duration)->diffForHumans(Carbon::parse($task->beginning));
                    }else {
                        $task->duration = Carbon::parse($task->beginning)->diffInDays(Carbon::parse($task->end)) . ' days and ' . Carbon::parse($task->beginning)->diff(Carbon::parse($task->end))->format('%H:%I');
                    }
                }
                Carbon::setLocale($local);
            }
        }


        //Notes
        $notes = Group::find($idGroup)->notes;

        //Meetings
        $meeting = Meeting::all()->where('idGroup','==', $idGroup);
        if(count($meeting)>0){
            foreach ($meeting as $m){
                $m->date = Carbon::parse($m->date)->isoFormat('MMMM Do YYYY, h:mm a');
            }
        }

        //schedule
        $groupUsers = StudentsGroup::all()->where('idGroup', "==", $idGroup);
        $Users = [];
        foreach ($groupUsers as $gu){
            $stg = User::find($gu->idStudent);
            array_push($Users, $stg);
        }
        $schedule = Availability::all()->where('idGroup','==', $idGroup);

        //Posts

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

        //Submission
        $submittedFiles = File::all()->where('idGroup','==', $idGroup)->where('finalState','==','final');

        return view('student.project')->with('project' , $project)->with('subject', $subject)->with('announcements', $allAnnouncements)->with('userPoster', $users)->with('numberComments', $numberComments)->with('tasks', $arr)->with('idGroup',$idGroup)->with('notes',$notes)->with('a',$announcements)->with('meeting',$meeting)->with('groupUsers', $Users)->with('schedule', $schedule)->with('rep',$rep)->with('submittedFiles',$submittedFiles);
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
        $submission = $request->input('submission');
        if ($submission == 'task') {
            $idTask = $request->input('task');
            $task = Task::find($idTask);
            if (!empty($request->input('description'))) {
                $task->description = $request->input('description');
            } else {
                $task->description = $task->value('description');
            }
            if (!empty($request->input('responsible'))) {
                $task->responsible = $request->input('responsible');
            } else {
                $task->responsible = $task->value('responsible');
            }
            if (!empty(Carbon::parse($request->input('beginning')))) {
                $task->beginning = Carbon::parse($request->input('beginning'));
            } else {
                $task->beginning = Carbon::parse($task->value('beginning'));
            }
            if (!empty(Carbon::parse($request->input('end')))) {
                $task->end = Carbon::parse($request->input('end'));
                $start = Carbon::parse($task->beginning);
                $end = Carbon::parse($request->input('end'));
                $task->duration = $start->diffInSeconds($end);



            } else {
                $task->end = Carbon::parse($task->value("end"));
            }

            $task->save();
            return redirect()->action('StudentProjectsController@show', $id)->with('success', 'Task updated successfully');
        }else{

            $idFiles = explode(',',$request->filesSubmit);
            foreach($idFiles as $idfile){
                $file = File::find($idfile);
                $file->finalState = 'final';
                $file->submissionTime = Carbon::now();
                $file->save();
            }
            return redirect()->action('StudentProjectsController@show', $id)->with('success', 'File submitted successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $submission = $request->input('submission');
        if($submission == 'task'){
            $idTask = $request ->input('task');
            $task = Task::find($idTask);
            $task ->delete();
            return redirect()->action('StudentProjectsController@show', $id)->with('success', 'Task deleted successfully');
        }
        else{
            $idGroup = $request->input('group');
            $idFile = $request->input('idFile');
            $file = File::find($idFile);
            Storage::delete('studentRepository/'.$idGroup.'/'.$file->pathFile);
            $file->delete();
            return redirect()->action('StudentProjectsController@show', $id)->with('success', 'File deleted successfully');


        }
    }



}
