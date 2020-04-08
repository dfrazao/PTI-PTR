<?php

namespace App\Http\Controllers;

use App\Project;
use App\Subject;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subjects = Subject::all();
        $projects = Project::all();
        return view('dashboard')->with('projects', $projects)->with('subjects', $subjects);;
    }
}
