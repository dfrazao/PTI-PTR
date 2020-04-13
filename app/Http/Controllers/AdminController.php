<?php

namespace App\Http\Controllers;
use App\GeneralSubjects;
use App\SubjectEnrollment;
use App\AcademicYear;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
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

            $subjects = Subject::all();
            $general_subjects = GeneralSubjects::all();
            $academicYears = AcademicYear::all();

            return view('admin.tables')->with('data',$subjects)->with('general_subjects',$general_subjects)->with('academicYears',$academicYears);

        }elseif ($table == 'subjectEnrollments'){

            $users = User::all();
            $enroll = SubjectEnrollment::all();
            $subjects = Subject::all();

            return view('admin.tables')->with('data',$enroll)->with('subjects',$subjects)->with('users',$users);
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
            $user->photo = $request->input('photo');
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
    public function update(Request $request, $id)
    {
        $users = User::find($id);
        $users->uniNumber = $request->input('idNumber');
        $users->role = $request->input('role');
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->photo = $request->input('photo');
        $users->country = $request->input('country');
        $users->city = $request->input('city');
        $users->description = $request->input('description');
        $users->update();
        return redirect('admin/')->with('success','Data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('admin')->with('success','Data deleted');
    }

    public function import(Request $request)
    {

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

            $id = $data['id'];
            $uniNumber = $data['uninumber'];
            $role = $data['role'];
            $name = $data['name'];
            $email = $data['email'];
            $email_verified_at = $data['emailverifiedat'];
            $password = $data['password'];
            $photo = $data['photo'];
            $country = $data['country'];
            $city = $data['city'];
            $remember_token = $data['remembertoken'];
            $created_at = $data['createdat'];
            $updated_at = $data['updatedat'];
            $description = $data['description'];

            $user = new User;
            $user-> uniNumber = $uniNumber;
            $user-> role = $role;
            $user-> name = $name;
            $user-> email = $email;
            $user-> password = Hash::make($password);
            $user-> photo = $photo;
            $user->country = $country;
            $user->city = $city;
            $user->save();
        }
        return redirect('admin/')->with('success','Data Added');

    }


}
