<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Controllers\Controller;
use App\SubjectEnrollment;
use Illuminate\Http\Request;
use App\Announcement;
use App\AnnouncementComment;
use App\Project;
use App\Subject;
use Auth;
use App\User;
use DB;
use App\StudentsGroup;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort('404');
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
        $user = Auth::user();
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

        $my_id = Auth::id();

        $project = DB::table('projects')->where('idProject', '=', $id)->value('idSubject');

        $enrollm = SubjectEnrollment::all()->where('idSubject','=',$project)->pluck('idUser');

        $project_name = DB::table('projects')->where('idProject', '=', $id)->value('name');

        $subject = DB::table('subjects')->where('idSubject', '=', $project)->value('subjectName');
        if($enrollm->count() > 0){
            foreach ($enrollm as $u){
                $users = User::all()->where('id', '=', $u)->where('id', '!=', $my_id);
                foreach ($users as $user){
                    $user->notify(new \App\Notifications\InvoicePaid($my_id,"Posted", $id ,$project_name,$subject));
                }
            }
        }


        return redirect()->to(url()->previous() . '#forum')->with('success', trans('gx.postCreated'));
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

        return redirect()->to(url()->previous())->with('success', trans('gx.commentPosted'));
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

        $role = Auth::user()->role;
        if($role == "student" and strpos(url()->current(), "professor") == true) {
            return redirect("/student/project/".$id."/post/".$id2);
        } elseif ($role == "professor" and strpos(url()->current(), "student") == true) {
            return redirect("/professor/project/".$id."/post/".$id2);
        }

        $announcement = Announcement::find($id2);

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

                if ($role == "student") {
                    $idGroups = Group::all()->where('idProject', '==', $announcement->idProject)->pluck('idGroup');
                    $studentGroups = StudentsGroup::all()->where('idStudent', '==', Auth::user()->id)->pluck('idGroup');
                    $idGroup = 0;
                    foreach($studentGroups as $st)
                        foreach ($idGroups as $g)
                            if ($g == $st)
                                $idGroup = $g;

                    return view('post')->with('announcement',$announcement)->with('project',$project)->with('subject',$subject)->with('poster',$poster)->with('comments',$comments)->with('commenters',$commenters)->with('idGroup',$idGroup);
                }

                return view('post')->with('announcement',$announcement)->with('project',$project)->with('subject',$subject)->with('poster',$poster)->with('comments',$comments)->with('commenters',$commenters);
            }
            //dd($announcement->idProject);
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
            'body2' => 'required'
        ]);

        $announcement = Announcement::find($id2);
        $announcement->title = $request ->input('title');
        $announcement->body = $request->input('body2');
        $announcement->date = date("Y-m-d H:i:s");
        $announcement->save();

        return redirect()->to(url()->previous())->with('success', trans('gx.postEdited'));
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

            return redirect()->to("/student/project/". $id . '#forum')->with('success', trans('gx.postDeleted'));

        } elseif($option == 'comment') {

            $announcementComment = AnnouncementComment::find($request ->input('comment'));
            $announcementComment->delete();

            return redirect()->to(url()->previous())->with('success', trans('gx.commentDeleted'));
        }
    }
}
