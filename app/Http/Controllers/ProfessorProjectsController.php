<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\Subject;
use App\Group;
use App\StudentsGroup;
use App\User;

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
            $project->name = $request->input('title');
            $project->dueDate = $request->input('deadline');
            $project->groupCreationDueDate = $request->input('group_formation_deadline');
            $project->maxElements = $request->input('number');
            $project->idSubject = $request->input('subject');
            $project->save();

            return redirect('/')->with('success', 'Project Created');

        } else {
            $this->validate($request, [
                'grade' => 'required'
            ]);

            $projectId = $request->project;
            $group = Group::find($request-> group);
            $group->grade = $request->grade;
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
        return view('professor.project')->with('project' , $project)->with('subject', $subject)->with('groups', $groups);
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
            $project->name = $request->input('title');
            $project->dueDate = $request->input('deadline');
            $project->groupCreationDueDate = $request->input('group_formation_deadline');
            $project->maxElements = $request->input('number');
            $project->idSubject = $project->idSubject;
            $project->save();

            return redirect('/')->with('success', 'Project Updated');

        } else {
            $this->validate($request, [
                'grade' => 'required'
            ]);

            $group = Group::find($request->group);
            $group->grade = $request->grade;
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
