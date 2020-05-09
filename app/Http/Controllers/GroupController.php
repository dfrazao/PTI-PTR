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
        foreach($idStudent as $id) {
            $studentGroup = new StudentsGroup;
            $studentGroup->idGroup = $group->idGroup;
            $studentGroup->idStudent = $id;
            $studentGroup->save();
        }







        //TODO :funcao js para nao permitir selecionar elementos para o grupo de forma a que
        // n ultrapasse o max elements(pessoa que cria o grupo inclusive) com variavel de sessao , fazer
        // com que a criacao de grupo contemple o user corrente , na sugestao de alunos fazer os filtros(ordenar) e enviar mensagem




   return redirect()->action('DashboardController@index', $idProject)->with('success', 'Group created successfully');


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
            ->get(['name','uniNumber','class','id','average']);


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
            //->pluck('idGroup','uniNumber')
            ->get(['idGroup','name','uniNumber','id','photo']);


        $students_per_group = $studentsGroup -> groupBy('idGroup');

        $groupNumber = $students_per_group->keys();  //keys

        //funcao para contar numero de groupos dentro do projeto
        $numberGroupsInsideProject = DB::table('groups')
            ->distinct('idGroupProject')
            ->count();



        /*foreach($groupNumber as $groupN)
            foreach($students_per_group[$groupN] as $studInfo)
                if($user == $studInfo->id)
                    return redirect()->action('DashboardController@index', $project);
                else*/

                    return view('student/groups')->with('groupNumber',$groupNumber)->with('students_per_group',$students_per_group)->with('subjectStudentsNoGroup',$subjectStudentsNoGroup)->with('projectMaxElements',$projectMaxElements)->with('project',$project)
                        ->with('numberGroupsInsideProject',$numberGroupsInsideProject)->with('subject',$subject)->with('user',$user);

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

        //redirect para pagina do projeto?
        return redirect()->action('DashboardController@index', $idProject)->with('success', 'Successfully joined the group '.$idGroup);
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


