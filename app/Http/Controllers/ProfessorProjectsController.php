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
                'group_formation_deadline' => 'required'
            ]);


            $project = new Project;
            $project->name = $request->title;
            $project->dueDate = $request->deadline;
            $project->groupCreationDueDate = $request->group_formation_deadline;
            $project->minElements = $request->minNumber;
            $project->maxElements = $request->maxNumber;
            $project->idSubject = $request->subject;
            $project->maxGroups = SubjectEnrollment::all()->where('idSubject', '==', $request->subject)->count();
            $project->save();

            return redirect('/')->with('success', 'Project Created');

        } else {
            $this->validate($request, [
                'grade' => 'required'
            ]);

            $projectId = $request->project;
            $group = Group::find($request-> group);
            $group->grade = $request->grade;
            $group->gradeComment = $request->gradeComment;
            $group->save();

            return redirect('professor/project/'.$projectId)->with('success', 'Grade Given');
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
        $subject = Subject::find($project->idSubject);
        $groups = Group::all()->where('idProject', '==', $id);

        /*$announcement = Announcement::all()->where('idProject', '==', $id);*/

        $announcements = Announcement::all()->where('idProject', '==', $id);
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


        return view('professor.project')->with('numberComments', $numberComments)->with('project' , $project)->with('subject', $subject)->with('groups', $groups)->with('announcements', $allAnnouncements)->with('a',$announcements)->with('userPoster', $users);
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
                'deadline' => 'required',
                'group_formation_deadline' => 'required'
            ]);

            $project = Project::find($id);
            $project->name = $request->title;
            $project->dueDate = $request->deadline;
            $project->groupCreationDueDate = $request->group_formation_deadline;
            $project->minElements = $request->minNumber;
            $project->maxElements = $request->maxNnumber;
            $project->idSubject = $project->idSubject;
            $project->maxGroups = SubjectEnrollment::all()->where('idSubject', '==', $request->subject)->count();
            $project->save();

            return redirect('/')->with('success', 'Project Updated');

        } else {
            $this->validate($request, [
                'grade' => 'required'
            ]);

            $group = Group::find($request->group);
            $group->grade = $request->grade;
            $group->gradeComment = $request->gradeComment;
            $group->save();

            return redirect('professor/project/'.$id)->with('success', 'Grade Updated');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proj = Project::find($id);
        $proj->delete();
        return redirect('/')->with('success', 'Project Deleted');
    }
}
