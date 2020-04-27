<?php

namespace App\Http\Controllers;


use App\StudentsGroup;
use App\SubjectEnrollment;
use App\User;
use Illuminate\Http\Request;
use App\Group;
use App\Subject;
use App\Project;
use mysql_xdevapi\Table;
use PhpParser\Node\Stmt\Foreach_;
use function foo\func;
use function GuzzleHttp\Promise\all;
use DB;
use Illuminate\Support\Arr;

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
        $group->idGroupProject = $numberGroupsInsideProject+1; //autoincrementar?
        $group->idProject = $idProject;
        $group->save();

        $idStudent = $request ->input('idStudent');
        $studentGroup = new StudentsGroup;
        $studentGroup->idGroup = $group->idGroup;
        $studentGroup->idStudent = $idStudent; //compor isto!!!!!
        $studentGroup->save();


        //TODO :funcao js para nao permitir selecionar elementos para o grupo de forma a que
        // n ultrapasse o max elements(pessoa que cria o grupo inclusive) com variavel de sessao , fazer
        // com que a criacao de grupo contemple o user corrente , na sugestao de alunos fazer os filtros(ordenar) e enviar mensagem??




   return redirect()->action('GroupController@show', $idProject)->with('success', 'Group created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
            ->get(['name','uniNumber','class','id']);


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
            ->get(['idGroup','name','uniNumber']);


        $students_per_group = $studentsGroup -> groupBy('idGroup');

        $groupNumber = $students_per_group->keys();  //keys

        //funcao para contar numero de groupos dentro do projeto
        $numberGroupsInsideProject = DB::table('groups')
            ->distinct('idGroupProject')
            ->count();

        return view('student/groups')->with('groupNumber',$groupNumber)->with('students_per_group',$students_per_group)->with('subjectStudentsNoGroup',$subjectStudentsNoGroup)->with('projectMaxElements',$projectMaxElements)->with('project',$project)
            ->with('numberGroupsInsideProject',$numberGroupsInsideProject);
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


