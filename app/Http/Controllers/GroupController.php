<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\Meeting;
use Illuminate\Http\Request;
use App\Project;
use App\Subject;
use App\Announcement;
use App\AnnouncementComment;
use App\User;
use Auth;
use App\Group;
use App\StudentsGroup;


use App\SubjectEnrollment;

use DB;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return view('student/groups')->with('alunos',$alunos )->with('grupos',$grupos );
        //->with('grupos_correntes',$grupos_correntes );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.groups');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        ]);

        $idProject = $request ->input('project');
        $numberGroupsInsideProject = $request ->input('numberGroupsInsideProject');
        $group = new Group;
        $group->idGroupProject = $numberGroupsInsideProject+1;
        $group->idProject = $idProject;
        $group->save();


        $idStudent = $request ->input('idStudent');
        $idUser = $request ->input('userId');
        $studentGroup = new StudentsGroup;
        $studentGroup->idStudent = $idUser;
        $studentGroup->idGroup = $group->idGroup;
        $studentGroup->save();
        if(!empty($idStudent)){
            foreach($idStudent as $id) {
                $studentGroup = new StudentsGroup;
                $studentGroup->idGroup = $group->idGroup;
                $studentGroup->idStudent = $id;
                $studentGroup->save();
            }

        }







        return redirect()->action('StudentProjectsController@show', $idProject)->with('success', 'Group created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->id;
        //echo gettype($user);
        //return $user;
        $project = Project::find($id);
        $projectMaxElements = $project->maxElements;
        $projectMinElements = $project->minElements;
        $projectMaxGroups = $project->maxGroups;
        $subject = Subject::find($project->idSubject);
        $idSubject = $subject->idSubject;
        $groups = Group::all()->where('idProject','==', $id);




        $groupStudents = DB::table('studentGroups')
            ->join('groups', function($join) use($id) {
                $join->on('groups.idGroup', '=', 'studentGroups.idGroup')
                    ->where('groups.idProject','=',$id);
            })
            ->pluck('idStudent')->toArray();



        //Alunos sem grupo
        $subjectStudentsNoGroup = DB::table('users')
            ->where('users.role','=','student')
            ->join('subjectEnrollments', function($join) use($idSubject) {
                $join->on('subjectEnrollments.idUser', '=', 'users.id')
                    ->where('subjectEnrollments.idSubject','=',$idSubject);

            })
            ->whereNotIn('id',$groupStudents)
            ->where('id','!=',$user)
            ->get(['name','uniNumber','class','id']);



        //Alunos sem grupo
        $studentsSugestions = DB::table('users')
            ->where('users.role','=','student')
            ->join('subjectEnrollments', function($join) use($idSubject) {
                $join->on('subjectEnrollments.idUser', '=', 'users.id')
                    ->where('subjectEnrollments.idSubject','=',$idSubject);

            })
            ->whereNotIn('id',$groupStudents)
            ->where('id','!=',$user)
            ->join('evaluations',function($join) use($idSubject){
                $join->on('subjectEnrollments.idUser', '=', 'evaluations.receiver');
            })

            ->get(['id','grade','name','uniNumber','class']);

        $studentsSugestions1 = DB::table('users')
            ->where('users.role','=','student')
            ->join('subjectEnrollments', function($join) use($idSubject) {
                $join->on('subjectEnrollments.idUser', '=', 'users.id')
                    ->where('subjectEnrollments.idSubject','=',$idSubject);

            })
            ->whereNotIn('id',$groupStudents)
            ->where('id','!=',$user)
            ->join('evaluations',function($join) use($idSubject){
                $join->on('subjectEnrollments.idUser', '=', 'evaluations.receiver');
            })

            ->get(['id','grade','name','uniNumber','class']);



        return $studentsSugestions1;
        $studSugestions = $studentsSugestions->groupBy('id');
        foreach($studSugestions as $st)
            return $st[0]->id;

        //return $studSugestions;


        $gradeArray = array();
        $idArray = array();
        $studIdArray = $studentsSugestions->groupBy('id')->keys();


        foreach($studentsSugestions as $stud)
            array_push($idArray,$stud->id);

        foreach($studentsSugestions as $stud)
            array_push($gradeArray,$stud->grade);



        $sumGrade = array_unique($idArray);
        $sumGrade = array_combine($sumGrade, array_fill(0, count($sumGrade), 0));

        foreach($idArray as $k=>$v) {
            $sumGrade[$v] += $gradeArray[$k];
        }

        $avgArray = array();

        foreach($sumGrade as $key=>$v)
            foreach (array_count_values($idArray) as $occ=>$oc)
                if($key == $occ)
                    array_push($avgArray,($v / $oc));


        $avgStudent = array_combine($studIdArray->toArray(),$avgArray);

        return $avgStudent;



        //----------------------------------------------------------------------------------------------------------------


        $idGroups = $groups->pluck('idGroup')->toArray();

        $studentsGroup = DB::table('users')
            ->where('users.role','=','student')
            ->join('subjectEnrollments', function($join) use($idSubject) {
                $join->on('subjectEnrollments.idUser', '=', 'users.id')
                    ->where('subjectEnrollments.idSubject','=',$idSubject);

            })
            ->whereIn('id',$groupStudents)
            ->join('studentGroups', function($join) use($idSubject,$idGroups) {
                $join->on('studentGroups.idStudent', '=', 'users.id')
                    ->whereIn('studentGroups.idGroup',$idGroups);

            })
            ->join('groups', function($join) use($idSubject,$idGroups) {
                $join->on('groups.idGroup', '=', 'studentGroups.idGroup');

            })
            ->get(['idGroupProject','studentGroups.idGroup','name','uniNumber','id','photo']);

        $studentsIdGroup = DB::table('users')
            ->where('users.role','=','student')
            ->join('subjectEnrollments', function($join) use($idSubject) {
                $join->on('subjectEnrollments.idUser', '=', 'users.id')
                    ->where('subjectEnrollments.idSubject','=',$idSubject);

            })
            ->whereIn('id',$groupStudents)
            ->join('studentGroups', function($join) use($idSubject,$idGroups) {
                $join->on('studentGroups.idStudent', '=', 'users.id')
                    ->whereIn('studentGroups.idGroup',$idGroups);

            })
            ->join('groups', function($join) use($idSubject,$idGroups) {
                $join->on('groups.idGroup', '=', 'studentGroups.idGroup');

            })
            ->get(['id']);


        $students_per_group = $studentsGroup -> groupBy('idGroup');
        $groupNumber = $students_per_group->keys();
        $studentsIdGroupValues = array_values(array_column($studentsIdGroup->toArray(), 'id'));



        $numberGroupsInsideProject = DB::table('groups')
            ->where('groups.idProject','=',$project->idProject)
            ->distinct('idGroup')
            ->count();



        return view('student/groups')->with('groupNumber',$groupNumber)->with('students_per_group',$students_per_group)->with('subjectStudentsNoGroup',$subjectStudentsNoGroup)->with('projectMaxElements',$projectMaxElements)->with('projectMinElements',$projectMinElements)->with('project',$project)
            ->with('numberGroupsInsideProject',$numberGroupsInsideProject)->with('subject',$subject)->with('user',$user)->with('projectMaxGroups',$projectMaxGroups)->with('studentsIdGroupValues',$studentsIdGroupValues)->with('studentsSugestions',$studentsSugestions)->with('avgStudent',$avgStudent);

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
    public function update(Request $request)
    {
        $idProject = $request ->input('idProject');
        $idUser = $request->input('userJoin');
        $idGroup = $request ->input('idGroupJoin');

        $studentGroup = new StudentsGroup;
        $studentGroup->idStudent = $idUser;
        $studentGroup->idGroup = $idGroup;
        $studentGroup->save();


        return redirect()->action('StudentProjectsController@show', $idProject)->with('success', 'Successfully joined the group '.$idGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $idUser = Auth::user()->id;
        $idGroup = $request->idGroup;
        $group = Group::find($idGroup);
        $project = Project::find($id);
        $studentGroup = DB::table('studentGroups')->where('idStudent','=',$idUser)->where('idGroup','=',$idGroup);
        $numberStudentsGroup = DB::table('studentGroups')->where('idGroup','=',$idGroup)->count();

        if($numberStudentsGroup==1)
            $group->delete();
        else
            $studentGroup->delete();

        return redirect()->action('DashboardController@index',$project->idProject)->with('success', __('gx.successfully left the group') .$idGroup);
    }
}


