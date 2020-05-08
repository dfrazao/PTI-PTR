<?php

namespace App\Http\Controllers;

use App\Availability;
use App\Http\Controllers\Controller;
use App\Meeting;
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
use DateTime;
use function Sodium\add;

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
            $task-> beginning = $request->input('beginning');
            $task->save();

            return redirect()->action('StudentProjectsController@show', $idProject)->with('success', 'Task created successfully');
        }
        elseif($submission == "schedule"){
            $group = $request->input('group');

            if(Availability::where("idGroup", $group)->where('member',$user)->count() > 0){
                $availability = Availability::where("idGroup", $group)->where("member", $user)->first();
                $currentAv = json_decode($availability->periods);
                array_push($currentAv, $request->input('cell'));
                $availability->periods = $currentAv;
                $availability->save();
            }
            else {
                $av = [];
                $availability = new Availability;
                array_push($av,$request->input('cell'));
                $availability -> idGroup = $group;
                $availability -> member = $user;
                $availability -> periods = json_encode($av);
                $availability -> color = 'Green';
                $availability->save();

            }

        }
        else{
            $this->validate($request, [
                'description' => 'required',
                'place' => 'required',
                'date' => 'required',
                'time' => 'required'
            ]);
            $meeting = new Meeting;
            $meeting -> idGroup = $request->input('group');
            $meeting -> description = $request->input('description');
            $meeting -> date = $request->input('date');
            $meeting -> hour = $request->input('time');
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

        // Tasks
        $arr = Task::all()->where('idGroup', '==', $idGroup);

        //Notes
        $notes = Group::find($idGroup)->notes;

        //Meetings
        $meeting = Meeting::all()->where('idGroup','==', $idGroup);

        //schedule
        $groupUsers = StudentsGroup::all()->where('idGroup', "==", $idGroup);
        $Users = [];
        foreach ($groupUsers as $gu){
            $stg = User::find($gu->idStudent);
            array_push($Users, $stg);
        }

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
        // availabilities
        $schedule = Availability::all()->where('idGroup','==', $idGroup);

        return view('student.project')->with('project' , $project)->with('subject', $subject)->with('announcements', $allAnnouncements)->with('userPoster', $users)->with('numberComments', $numberComments)->with('tasks', $arr)->with('idGroup',$idGroup)->with('notes',$notes)->with('a',$announcements)->with('meeting',$meeting)->with('groupUsers', $Users)->with('schedule', $schedule);
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
        if (!empty($request->input('beginning'))) {
            $task->beginning = $request->input('beginning');
        } else {
            $task->beginning = $task->value('beginning');
        }
        if (!empty($request->input('end'))) {
            $task->end = $request->input('end');
            $start = $task->beginning;
            $end = $task->end;
            $datetime1 = new DateTime($start);
            $datetime2 = new DateTime($end);
            $interval = $datetime1->diff($datetime2);
            $diff = $interval->format('%a');
            $task->duration = $diff;

        } else {
            $task->end = $task->value("end");
        }

        $task->save();
        return redirect()->action('StudentProjectsController@show', $id)->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $idTask = $request ->input('task');
        $task = Task::find($idTask);
        $task ->delete();
        return redirect()->action('StudentProjectsController@show', $id)->with('success', 'Task updated successfully');
    }

}
