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

        $user = User::find($id);
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->description = $request->input('about');
        $user->save();

        return redirect('/profile/'.$id)->with('success', 'Profile Updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfilePhoto(Request $request, $id)
    {
        $this->validate($request, [
            'profilePhoto' => 'required|image|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('profilePhoto')){
            // Get filename with the extension
            $filenameWithExt = $request->file('profilePhoto')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profilePhoto')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $id.'.'.$extension;
            // Upload Image
            $path = $request->file('profilePhoto')->storeAs('public/profilePhotos', $fileNameToStore);
        } else {
            $fileNameToStore = 'profilePhotoDefault.jpg';
        }

        $user = User::find($id);
        $user->photo = $fileNameToStore;
        $user->save();

        return redirect('/profile/'.$id)->with('success', 'Profile Picture Updated');
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
