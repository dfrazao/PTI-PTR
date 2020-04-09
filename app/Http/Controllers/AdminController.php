<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

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
    public function index()
    {
        $users = User::all();
        return view('admin.tables')->with('users',$users);
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
        $this->validate($request,[
            'uniNumber' => 'required',
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User;
        $user-> uniNumber = $request->input('uniNumber');
        $user-> role = $request->input('role');
        $user-> name = $request->input('name');
        $user-> email = $request->input('email');
        $user-> password = Hash::make($request->input('password'));
        $user-> photo = $request->input('photo');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->description = $request->input('description');
        $user->save();
        return redirect('admin/tables')->with('success','User Added');

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
        return redirect('admin/tables')->with('success','User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
