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
        foreach ($subjectsEnrolled as $se) {
            $subjects = Subject::all()->where('idSubject', '==', $se);
            $subjectsId = Subject::all()->where('idSubject', '==', $se)->pluck('idSubject');
        }
        foreach ($subjectsId as $sid) {
            $projects = Subject::all()->where('idSubject', '==', $sid);
        }
        return view('dashboard')->with('subjects', $subjects)->with('projects', $projects);
    }
}
