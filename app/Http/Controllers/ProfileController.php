<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use App\User;
use App\StudentsCourse;
use App\Course;
use App\University;
use App\Subject;
use App\SubjectEnrollment;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
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
        $user = User::find($id);
        $courseId = StudentsCourse::all()->where('idStudent', '==', $id)->pluck('idCourse')->first();
        $courseName = Course::all()->where('idCourse', '==', $courseId)->pluck('name')->first();
        $universityId = Course::all()->where('idCourse', '==', $courseId)->pluck('idUniversity')->first();
        $universityName = University::all()->where('idUniversity', '==', $universityId)->pluck('name')->first();
        return view('profile')->with('user', $user)->with('courseName', $courseName)->with('universityName', $universityName);
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
        $this->validate($request, [
            'country' => 'required',
            'city' => 'required',
        ]);


        $profile = User::find($id);
        $profile->country = $request->input('country');
        $profile->city = $request->input('city');
        $profile->description = $request->input('description');
        $profile->save();

        return redirect('/')->with('success', 'Profile Updated');
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
