<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\Subject;
use App\Announcement;
use App\AnnouncementComment;
use App\User;

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
        $posts = Announcement::all()->where('idProject', '==', $id);
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

        return view('student.project')->with('project' , $project)->with('subject', $subject)->with('posts', $posts)->with('userPoster', $users)->with('numberComments', $numberComments);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
