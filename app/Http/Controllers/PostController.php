<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Announcement;
use App\AnnouncementComment;
use App\Project;
use App\Subject;
use App\User;
use Auth;

class PostController extends Controller
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
            'title' => 'required',
            'body' => 'required'
        ]);

        $id = $request ->input('project');

        $announcement = new Announcement();
        $announcement->idProject = $id;
        $announcement->sender = Auth::user()->id;
        $announcement->title = $request ->input('title');
        $announcement->body = $request->input('body');
        $announcement->date = date("Y-m-d H:i:s");
        $announcement->save();

        return redirect()->to(url()->previous() . '#forum')->with('success', 'Post Created');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $announcementComment = new AnnouncementComment();
        $announcementComment->idAnnouncement = $request->input('announcement');
        $announcementComment->sender = Auth::user()->id;
        $announcementComment->comment = $request->input('comment');
        $announcementComment->date = date("Y-m-d H:i:s");
        $announcementComment->save();

        return redirect()->to(url()->previous())->with('success', 'Comment Posted');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param $id2
     * @return \Illuminate\Http\Response
     */
    public function show($id, $id2)
    {
        $announcement = Announcement::find($id2);
        //dd($id2);

        if($announcement != "") {
            if($announcement->idProject == $id) {
                $project = Project::find($announcement->idProject);
                $subject = Subject::find($project->idSubject);
                $poster = User::find($announcement->sender);
                $allComments = AnnouncementComment::all()->where('idAnnouncement', '==', $id2);
                $comments = [];
                foreach ($allComments as $ac) {
                    array_push($comments, $ac);
                }
                $commenters = [];
                foreach ($comments as $c) {
                    $user = User::find($c->sender);
                    array_push($commenters, $user);
                }

                return view('post')->with('announcement',$announcement)->with('project',$project)->with('subject',$subject)->with('poster',$poster)->with('comments',$comments)->with('commenters',$commenters);
            }
            abort(404);
        }
        abort(404);
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param $id2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $id2)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $announcement = Announcement::find($id2);
        $announcement->title = $request ->input('title');
        $announcement->body = $request->input('body');
        $announcement->date = date("Y-m-d H:i:s");
        $announcement->save();

        return redirect()->to(url()->previous())->with('success', 'Post Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param $id2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $id2)
    {
        $option = $request ->input('option');

        if ($option == 'post') {

            $announcement = Announcement::find($id2);
            $announcement->delete();

            return redirect()->to("/student/project/". $id . '#forum')->with('success', 'Post Deleted');
        } elseif($option == 'comment') {

            $announcementComment = AnnouncementComment::find($request ->input('comment'));
            $announcementComment->delete();

            return redirect()->to(url()->previous())->with('success', 'Comment Deleted');
        }
    }
}
