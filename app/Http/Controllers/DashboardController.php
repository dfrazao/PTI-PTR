<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;
use App\Subject;
use App\SubjectEnrollment;

class DashboardController extends Controller
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
        $user = Auth::user()->id;
        $subjectsEnrolled = SubjectEnrollment::all()->where('idUser', '==', $user)->pluck('idSubject');
        $subjects = Subject::all()->whereIn('idSubject', $subjectsEnrolled);
        $subjectsId = Subject::all()->whereIn('idSubject', $subjectsEnrolled)->pluck('idSubject');
        $projects = Project::all()->whereIn('idSubject', $subjectsId);

        return view('dashboard')->with('subjects', $subjects)->with('projects', $projects);
    }
}
