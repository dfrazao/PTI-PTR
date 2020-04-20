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

        return redirect()->action('StudentProjectsController@show', $id)->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param $id2
     * @return \Illuminate\Http\Response
     */
    public function show($id,$id2)
    {
        $announcement = Announcement::find($id2);
        if($announcement->idProject == $id) {
            $project = Project::find($announcement->idProject);
            $subject = Subject::find($project->idSubject);
            $poster = User::find($announcement->sender);

            return view('post')->with('announcement',$announcement)->with('project',$project)->with('subject',$subject)->with('poster',$poster);
        }
        return "Error";
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
    public function destroy($id, $id2)
    {
        return "delete";
    }
}
