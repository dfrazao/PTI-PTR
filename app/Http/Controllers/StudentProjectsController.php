<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $this->validate($request, [
            'description' => 'required',
            'responsible' => 'required',
            'beginning' => 'required'
        ]);

        $task = new Task;
        $idProject = $request ->input('project');
        $task-> idGroup = $request ->input('group');
        $task-> description = $request->input('description');
        $task-> responsible = $request->input('responsible');
        $task-> beginning = $request->input('beginning');
        $task->save();

        return redirect()->action('StudentProjectsController@show', $idProject)->with('success', 'Task created successfully');

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
        $arr = Task::all()->where('idGroup', '==', $idGroup);
        $posts = Announcement::all()->where('idProject', '==', $id);
        $allPosts = [];
        foreach ($posts as $p) {
            array_push($allPosts, $p);
        }
        $userId = $posts->pluck('sender');
        $users = [];
        foreach ($userId as $uId) {
            $user = User::find($uId);
            array_push($users, $user);
        }
        $idPost = $posts->pluck('idAnnouncement');
        $numberComments = [];
        foreach ($idPost as $idP) {
            $idComment = AnnouncementComment::all()->where('idAnnouncement', '==', $idP)->count();
            array_push($numberComments, $idComment);
        }

        return view('student.project')->with('project' , $project)->with('subject', $subject)->with('posts', $allPosts)->with('userPoster', $users)->with('numberComments', $numberComments)->with('tasks', $arr)->with('idGroup',$idGroup);
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
        $this->validate($request, [
            'description' => 'required',
            'responsible' => 'required',
            'beginning' => 'required'
        ]);

        $idTask = $request ->input('task');
        $task = Task::find($idTask);
        $task-> idGroup = $request ->input('group');
        $task-> description = $request->input('description');
        $task-> responsible = $request->input('responsible');
        $task-> beginning = $request->input('beginning');
        $task-> end = $request->input('end');
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
        return redirect()->action('TasksController@show', $id)->with('success', 'Task updated successfully');
    }
}
