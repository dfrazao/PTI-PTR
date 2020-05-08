<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\StudentsCourse;
use App\Course;
use App\University;
use App\Subject;
use App\SubjectEnrollment;
use Storage;
use Auth;
use Hash;

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

        $subjectsEnrolled = SubjectEnrollment::all()->where('idUser', '==', $id)->pluck('idSubject');
        if (count($subjectsEnrolled) > 0) {
            $subjects = Subject::all()->whereIn('idSubject', $subjectsEnrolled);

            return view('profile')->with('user', $user)->with('courseName', $courseName)->with('universityName', $universityName)->with('subjects', $subjects);
        }
        else{
            return view('profile')->with('user', $user)->with('courseName', $courseName)->with('universityName', $universityName)->with('subjects', $subjectsEnrolled);
        }
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
        if ($request->option=="image") {
            $this->validate($request, [
                'profilePhoto' => 'required|image|max:1999'
            ]);
            if( $request->hasFile('profilePhoto')  ) {
                $file = $request->file('profilePhoto');
            }

            $extension = $request->profilePhoto->extension();
            $filename = uniqid().'.'.$extension;
            $file->storeAs('profilePhotos/', $filename, 'gcs');
            $user = User::find($id);
            if ($user->photo != "profilePhotoDefault.jpg") {
                Storage::delete('profilePhotos/'.$user->photo);
            }
            $user->photo = $filename;
            $user->save();

            if ($request->file('profilePhoto')->isValid()) {
                return redirect()->action('ProfileController@show', $id)->with('success', 'Profile picture updated');
            }
            return redirect()->action('ProfileController@show', $id)->with('error', 'Error updating profile picture');

        }  else if ($request->option=="password") {
            $this->validate($request, [
                'current_password' => 'required',
                'password' => 'required|same:password|min:8',
                'password_confirmation' => 'required|same:password|min:8'
            ]);

            $current_password = Auth::User()->password;
            if ( Hash::check($request->current_password, $current_password) ) {

                $user = User::find($id);
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->action('ProfileController@show', $id)->with('success', 'Password updated');
            } else {
                return redirect()->action('ProfileController@show', $id)->with('error', 'Error changing password');
            }

        } else {
            $this->validate($request, [
                'country' => 'required',
                'city' => 'required'
            ]);

            $user = User::find($id);
            $user->country = $request->input('country');
            $user->city = $request->input('city');
            $user->description = $request->input('about');
            $user->save();

            return redirect()->action('ProfileController@show', $id)->with('success', 'Profile Updated');
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
        //
    }
}
