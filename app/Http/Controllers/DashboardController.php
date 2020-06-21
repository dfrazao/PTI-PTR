<?php

namespace App\Http\Controllers;

use App\Group;
use App\StudentsGroup;
use Illuminate\Http\Request;
use Auth;
use App\AcademicYear;
use App\Project;
use App\Subject;
use App\SubjectEnrollment;
use App\User;
use App\Meeting;
use DB;

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
            $academicYears = AcademicYear::all()->sortKeysDesc();
            $subjects = Subject::all()->whereIn('idSubject', $subjectsEnrolled);
            $subjectsId = Subject::all()->whereIn('idSubject', $subjectsEnrolled)->pluck('idSubject');
            $projects = Project::all()->whereIn('idSubject', $subjectsId);

            $meetings = [];
            $groups = [];
            foreach ($projects as $p) {
                $idGroup = DB::table('studentGroups')
                    ->select('studentGroups.idGroup')
                    ->join('groups', 'studentGroups.idGroup', '=', 'groups.idGroup')
                    ->where('groups.idProject', $p->idProject)
                    ->where('studentGroups.idStudent', $user)
                    ->get();

                foreach ($idGroup as $idg) {
                    $p->group = $idg->idGroup;
                    if (!in_array($idg->idGroup, $groups)) {
                        $meeting = Meeting::all()->where('idGroup', '==', $idg->idGroup);
                        foreach ($meeting as $m) {
                            $proj = Project::find($p->idProject);
                            $m->project = $proj->name;
                            $m->subject = Subject::find($proj->idSubject)->subjectName;
                            array_push($meetings, $m);
                        }
                        array_push($groups, $idg->idGroup);
                    }
                }
            }


            return view('dashboard')->with('academicYears', $academicYears)->with('subjects', $subjects)->with('projects', $projects)->with('meetings', $meetings);
        }
        else{
            return view('dashboard')->with('subjects', $subjectsEnrolled);
        }
    }
}
