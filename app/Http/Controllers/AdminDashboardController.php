<?php

namespace App\Http\Controllers;
use App\Announcement;
use App\AnnouncementComment;
use App\Availabilities;
use App\Chats;
use App\Evaluations;
use App\GeneralSubjects;
use App\GroupChats;
use App\StudentsCourse;
use App\StudentsGroup;
use App\University;
use App\Course;
use DB;
use App\SubjectEnrollment;
use App\AcademicYear;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countUsers = User::all()->count();
        $countStudents = User::all()->where('role', '==', 'student')->count();
        $countProfessors = User::all()->where('role', '==', 'professor')->count();
        $countUniversities = University::all()->count();
        return view('admin.dashboard')->with('countUsers',$countUsers)->with('countStudents',$countStudents)->with('countProfessors',$countProfessors)->with('countUniversities',$countUniversities);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
