<?php

namespace App\Http\Controllers;

use App\Group;
use App\StudentsGroup;
use Illuminate\Http\Request;
use Auth;
use App\Project;
use App\Subject;
use App\SubjectEnrollment;
use DB;
use App\User;

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
        if (count($subjectsEnrolled) > 0) {
            /*foreach ($subjectsEnrolled as $se) {
                $subjects = Subject::all()->where('idSubject', '==', $se);
                $subjectsId = Subject::all()->where('idSubject', '==', $se)->pluck('idSubject');
            }
            foreach ($subjectsId as $sid) {
                $projects = Subject::all()->where('idSubject', '==', $sid);
            }*/
            $subjects = Subject::all()->whereIn('idSubject', $subjectsEnrolled);
            $subjectsId = Subject::all()->whereIn('idSubject', $subjectsEnrolled)->pluck('idSubject');
            $projects = Project::all()->whereIn('idSubject', $subjectsId);
            $projectsId = $projects->pluck('idProject');

            foreach ($projects as $p) {
                $idGroup = DB::table('studentGroups')
                    ->select('studentGroups.idGroup')
                    ->join('groups', 'studentGroups.idGroup', '=', 'groups.idGroup')
                    ->where('groups.idProject', $p->idProject)
                    ->where('studentGroups.idStudent', $user)
                    ->get();

                foreach ($idGroup as $idg)
                    $p->group = $idg->idGroup;
            }

            return view('dashboard')->with('subjects', $subjects)->with('projects', $projects);
        }
        else{
            return view('dashboard')->with('subjects', $subjectsEnrolled);
        }
    }
}
