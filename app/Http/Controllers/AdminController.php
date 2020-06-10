<?php

namespace App\Http\Controllers;
use App\Announcement;
use App\AnnouncementComment;
use App\Availabilities;
use App\Chats;
use App\Evaluations;
use App\GeneralSubjects;
use App\GroupChats;
use App\Jobs\Users;
use App\Jobs\UsersJob;
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
use phpDocumentor\Reflection\Types\Null_;
use Redirect;

use \App\Subject;
class AdminController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($table)
    {
        if ($table == 'users'){

            $users = User::all();
            return view('admin.tables')->with('data',$users);

        }elseif($table == 'subjects'){

            $subjects = Subject::with('generalSubject')->get();
            $general_subjects = GeneralSubjects::all();
            $academicYears = AcademicYear::all();

            return view('admin.tables')->with('data',$subjects)->with('general_subjects',$general_subjects)->with('academicYears',$academicYears);

        }elseif ($table == 'subjectEnrollments'){

            $users = User::all();
            $enroll = SubjectEnrollment::with('Subject')->with('User')->get();
            $subjects = Subject::all();

            return view('admin.tables')->with('data',$enroll)->with('subjects',$subjects)->with('users',$users);

        }elseif ($table == 'universities'){

            $university = University::all();

            return view('admin.tables')->with('data',$university);

        }elseif ($table == 'courses'){

            $courses = Course::all();
            $university = University::all();

            return view('admin.tables')->with('data',$courses)->with('universities',$university);
        }
        elseif ($table == 'academicYears'){

            $years = AcademicYear::all();

            return view('admin.tables')->with('data',$years);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = $request->input('table');
        if ( $table == 'users') {
            $this->validate($request, [
                'uniNumber' => 'required',
                'role' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = new User;
            $user->uniNumber = $request->input('uniNumber');
            $user->role = $request->input('role');
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->photo = "profilePhotoDefault.jpg";
            $user->country = $request->input('country');
            $user->city = $request->input('city');
            $user->description = $request->input('description');
            $user->save();
            return redirect('admin/users')->with('success', 'User Added');

        }elseif($table == 'subjects'){

            $subjects = new Subject();
            $subjects->idGeneralSubject = $request->input('idGenSubject');
            $subjects->subjectName = $request->input('subjectName');
            $subjects->class = $request->input('class');
            $subjects->academicYear = $request->input('academicYear');
            $subjects->save();
            return redirect('admin/subjects')->with('success', 'Subject Added');

        }elseif ($table == 'subjectEnrollments'){
            $subjectEnroll = new SubjectEnrollment();
            $subjectEnroll->idUser = $request->input('idUser');
            $subjectEnroll->idSubject = $request->input('idSubject');
            $subjectEnroll->Class = $request->input('class');
            $subjectEnroll->save();
            return redirect('admin/subjectEnrollments')->with('success', 'Enrollment Added');

        }elseif ($table == 'universities'){

            $university = new University();
            $university->name = $request->input('univName');

            $university->save();
            return redirect('admin/universities')->with('success', 'University Added');

        }elseif ($table == 'courses') {

            $courses = new Course();
            $courses->idUniversity = $request->input('idUniv');
            $courses->name = $request->input('coursename');

            $courses->save();
            return redirect('admin/courses')->with('success', 'Course Added');

        }elseif ($table == 'academicYears') {

            $years = new AcademicYear();
            $years->academicYear = $request->input('academicYear');
            $years->save();
            return redirect('admin/academicYears')->with('success', 'Academic Year Added');
        }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.edit-user')->with('users',$users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $table = $request->input('table');
        $idUser = $request->input('idUser');

        $idSub = $request->input('idSub');
        $classes = $request->input('classes');
        $classes_h = $request->input('classes_h');
        $idu = $request->input('iduser');

        $idUniv = $request->input('idUniv');

        $idCourse = $request->input('id');

        $idYear = $request->input('academicyear');

        if ( $table == 'users') {

//            $this->validate($request, [
//                'profilePhoto' => 'required|image|max:1999',
//            ]);

            $users = User::find($idUser);
            $users->uniNumber = $request->input('uniNumber');
            $users->role = $request->input('role');
            $users->name = $request->input('name');
            $users->email = $request->input('email');
            $users->password = Hash::make($request->input('password'));

            if( $request->hasFile('profilePhoto')  == true) {
                $file = $request->file('profilePhoto');
                $extension = $request->profilePhoto->extension();
                $filename = $idUser.'.'.$extension;
                $path = $file->storeAs('public/profilePhotos/', $filename);
                $users->photo = $filename;
            }

            $users->country = $request->input('country');
            $users->city = $request->input('city');
            $users->description = $request->input('description');
            $users->update();

            return redirect('admin/users')->with('success','User updated');

        }elseif($table == 'subjects'){


            $subjects = Subject::find($idSub);
            $subjects->idGeneralSubject = $request->input('idGenSubject');
            $subjects->subjectName = $request->input('subname');
            $subjects->class = $request->input('classes');
            $subjects->academicYear = $request->input('academicYear');
            $subjects->update();
            return redirect('admin/subjects')->with('success', 'Subject updated');

        }elseif ($table == 'subjectEnrollments'){
            //Está maaaaaaaaaaaaal
            $subjectEnroll = SubjectEnrollment::all()->where('idUser', '=', $idu, 'and')->where('idSubject', '=', $idSub);
            $subjectEnroll->Class = $classes;
            $subjectEnroll->update();
            return redirect('admin/subjectEnrollments')->with('success', 'Enrollment updated');
        }
        elseif ($table == 'universities'){
            $university = University::find($idUniv);
            $university->name = $request->input('univName');
            $university->update();
            return redirect('admin/universities')->with('success', 'University updated');
        }
        elseif ($table == 'courses'){
            $course = Course::find($idCourse);
            $course->name = $request->input('coursename');
            $course->update();
            return redirect('admin/courses')->with('success', 'Course updated');

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$table)
    {

        $id = $request->input('id');
        $idUser = $request->input('idUser');
        $idSubject = $request->input('idSubject');

        if ( $table == 'users') {

            $user = User::find($id);

            $user->delete();

            return redirect('admin/users')->with('success','User deleted');

        }
        elseif($table == 'subjects') {

            $subject = Subject::find($id);
            $subject->delete();

            return redirect('admin/subjects')->with('success', 'Subject deleted');
        }
        elseif($table == 'subjectEnrollments') {

            $subject = SubjectEnrollment::all()->where('idUser', '==', $idUser)->where('idSubject', '==', $idSubject);
            $subject->delete();

            return redirect('admin/subjectEnrollments')->with('success','Enrollment deleted');
        }
        elseif($table == 'universities') {

            $university = University::find($id);


            try {
                $university->delete();
            }
            catch (\Illuminate\Database\QueryException $e) {

                if($e->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                    return redirect('admin/universities')->with('fail','University can´t be deleted');

                }
            }



            return redirect('admin/universities')->with('success','University deleted');
        }
        elseif($table == 'courses') {

            $course = Course::find($id);
            $course->delete();

            return redirect('admin/courses')->with('success','Course deleted');

        }elseif($table == 'academicYears') {
            $year = AcademicYear::where('academicYear',$id);
            $year->delete();

            return redirect('admin/academicYears')->with('success','Academic Year deleted');
        }
    }



    public function import(Request $request, $table)
    {

        if ($table == "users"){
            $upload=$request->file('upload-file');
            $filePath=$upload->getRealPath();
            $file=fopen($filePath, 'r');
            $header = fgetcsv($file,1000,";");
            $allData = [];
            $id = DB::table('users')->latest('id')->first()->id;

            while (($columns = fgetcsv($file, 1000, ";")) !== FALSE){

                $data = array_combine($header, $columns);
                $id = $id + 1;
                $data['id'] = $id;
                $data['email_verified_at'] = date('Y-m-d H:i:s');
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                array_push($allData, $data);

            }
            UsersJob::dispatch($allData);
            return redirect('admin/users')->with('success','Users are being imported. It might take a while.');

        }elseif($table == 'subjects'){
                $upload=$request->file('upload-file');
                $filePath=$upload->getRealPath();
                $file=fopen($filePath, 'r');
                $header = fgetcsv($file,1000,";");

                $escapedHeader = [];
                foreach ($header as $key => $value){
                    $lheader = strtolower($value);
                    $escapedItem = preg_replace('/[^a-z]/', '',$lheader);
                    array_push($escapedHeader, $escapedItem);
                }

                while (($columns = fgetcsv($file, 1000, ";")) !== FALSE){
                    print_r($columns[0]);
                    if($columns[0] == ""){
                        continue;
                    }

                    $data = array_combine($escapedHeader, $columns);

                    $idGeneralSubject = $data['idgeneralsubject'];
                    $subjectName = $data['subjectname'];
                    $class = $data['class'];
                    $academicYear = $data['academicyear'];

                    $subject = new Subject();
                    $subject->idGeneralSubject = $idGeneralSubject;
                    $subject->subjectName = $subjectName;
                    $subject->class = $class;
                    $subject->academicYear =$academicYear;
                    $subject->save();
                }
                return redirect('admin/subjects')->with('success','Subjects Imported');

        }elseif ($table == 'subjectEnrollments'){

            $upload=$request->file('upload-file');
            $filePath=$upload->getRealPath();
            $file=fopen($filePath, 'r');
            $header = fgetcsv($file,1000,";");

            $escapedHeader = [];
            foreach ($header as $key => $value){
                $lheader = strtolower($value);
                $escapedItem = preg_replace('/[^a-z]/', '',$lheader);
                array_push($escapedHeader, $escapedItem);
            }

            while (($columns = fgetcsv($file, 1000, ";")) !== FALSE){
                print_r($columns[0]);
                if($columns[0] == ""){
                    continue;
                }

                $data = array_combine($escapedHeader, $columns);
                $idUser = $data['iduser'];
                $idSubject = $data['idsubject'];
                $class = $data['class'];

                $subjectEnroll = new SubjectEnrollment();
                $subjectEnroll->idUser = $idUser;
                $subjectEnroll->idSubject = $idSubject;
                $subjectEnroll->class = $class;
                $subjectEnroll->save();
                }

        }elseif($table == 'universities'){
            $upload=$request->file('upload-file');
            $filePath=$upload->getRealPath();
            $file=fopen($filePath, 'r');
            $header = fgetcsv($file,1000,";");

            $escapedHeader = [];
            foreach ($header as $key => $value){
                $lheader = strtolower($value);
                $escapedItem = preg_replace('/[^a-z]/', '',$lheader);
                array_push($escapedHeader, $escapedItem);
            }


            while (($columns = fgetcsv($file, 1000, ";")) !== FALSE){

                if($columns[0] == ""){
                    continue;
                }

                $data = array_combine($escapedHeader, $columns);

                $univName = $data['name'];

                $university = new University();
                $university-> name = $univName;
                $university->save();
                }
            return redirect('admin/universities')->with('success','Universities Imported');

        }elseif($table == 'courses'){
            $upload=$request->file('upload-file');
            $filePath=$upload->getRealPath();
            $file=fopen($filePath, 'r');
            $header = fgetcsv($file,1000,";");

            $escapedHeader = [];
            foreach ($header as $key => $value){
                $lheader = strtolower($value);
                $escapedItem = preg_replace('/[^a-z]/', '',$lheader);
                array_push($escapedHeader, $escapedItem);
            }


            while (($columns = fgetcsv($file, 1000, ";")) !== FALSE){

                if($columns[0] == ""){
                    continue;
                }

                $data = array_combine($escapedHeader, $columns);

                $name = $data['name'];
                $idUniv = $data['iduniversity'];

                $course = new Course();
                $course-> name = $name;
                $course-> idUniversity = $idUniv;
                $course->save();
            }
            return redirect('admin/courses')->with('success','Courses Imported');

        }elseif($table == 'academicYears'){
            $upload=$request->file('upload-file');
            $filePath=$upload->getRealPath();
            $file=fopen($filePath, 'r');
            $header = fgetcsv($file,1000,";");

            $escapedHeader = [];
            foreach ($header as $key => $value){
                $lheader = strtolower($value);
                $escapedItem = preg_replace('/[^a-z]/', '',$lheader);
                array_push($escapedHeader, $escapedItem);
            }


            while (($columns = fgetcsv($file, 1000, ";")) !== FALSE){

                if($columns[0] == ""){
                    continue;
                }

                $data = array_combine($escapedHeader, $columns);

                $academicYear = $data['academicyear'];

                $Year = new AcademicYear();
                $Year-> academicYear = $academicYear;
                $Year->save();
            }
            return redirect('admin/academicYears')->with('success','Academic Years Imported');
        }



    }


}
