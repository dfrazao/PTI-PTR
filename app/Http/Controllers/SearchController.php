<?php
namespace App\Http\Controllers;
use App\groupChat;
use Illuminate\Http\Request;
use DB;
use App\Chat;
use App\User;
use Auth;
use Storage;
class SearchController extends Controller
{
    public function index()
    {
        return view('searchchat');
    }
    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $my_id = Auth::id();

            if($request->search == null){
                if($request->entity == "person") {
                    $my_id = Auth::id();
                    $mu = DB::select('select m.*
                                    from chats m
                                    where m.id in (select max(m.id) as max_id
                                                   from chats m
                                                   WHERE m.sender = ' . $my_id . ' or m.receiver = ' . $my_id . '
                                                   group by least(m.receiver, m.sender), greatest(m.receiver, m.sender))
                                                   order by m.Date DESC');

                    foreach ($mu as $m) {

                        if($m->sender != $my_id){
                            $user_m = User::find($m->sender);
                        }else{
                            $user_m = User::find($m->receiver);
                        }

                        if ($m->isread == 0 && $m->sender!= $my_id) {
                                $source = Storage::url('profilePhotos/' . $user_m->photo);
                                $output .=
                                    "<li class='user' id='" . $user_m->id . "' name=''>" .
                                    "<span class='pending'></span>" .
                                    "<input type='hidden' id='name".$user_m->id."' name='custId' value='" . $user_m->name . "'>" .
                                    "<input type='hidden' id='entity' name='entity' value='person'>" .
                                    "<div class='media'>" .
                                    "<div class='media-left'>" .
                                    "<img src='" . $source . "' alt='' class='media-object'>" .
                                    '</div>' .
                                    '<div class="media-body">' .
                                    '<p class="name">' . $user_m->name . '</p>' .
                                    '</div>' .
                                    '</div>' .
                                    '</li>';
                            } else {
                                $source = Storage::url('profilePhotos/' . $user_m->photo);

                                $output .=
                                    "<li class='user' id='" . $user_m->id . "' name=''>" .
                                    "<input type='hidden' id='name".$user_m->id."' name='custId' value='" . $user_m->name . "'>" .
                                    "<input type='hidden' id='entity' name='entity' value='person'>" .
                                    "<div class='media'>" .
                                    "<div class='media-left'>" .
                                    "<img src='" . $source . "' alt='' class='media-object'>" .
                                    '</div>' .
                                    '<div class="media-body">' .
                                    '<p class="name">' . $user_m->name . '</p>' .
                                    '</div>' .
                                    '</div>' .
                                    '</li>';
                            }


                    }
                    return Response($output);


                }elseif ($request->entity == "group"){

                    $collection = collect([]);
                    $query = DB::select('SELECT groupChats.idGroup, groupChats.sender ,groupChats.isread, groups.idGroupProject, subjects.subjectName, projects.name from groupChats
                    LEFT JOIN groups ON groupChats.idGroup = groups.idGroup 
                    LEFT JOIN studentGroups ON groupChats.idGroup = studentGroups.idGroup 
                    LEFT JOIN subjects ON groups.idProject = subjects.idSubject 
                    LEFT JOIN projects ON groups.idProject = projects.idProject 
                    WHERE groupChats.id in (SELECT max(groupChats.id) as max_id
                                               FROM groupChats
                                               GROUP BY groupChats.idGroup) AND studentGroups.idStudent = '.$my_id.'
                                               ORDER BY groupChats.Date DESC');
                    if(count($query) == 0){
                        $output .=
                            '<li >'.
                            '<div class="media">'.
                            '<div class="media-body">'.
                            '<div style="padding: 10px; text-align: center; ">'.
                            '<p><i class="fal fa-exclamation"></i> Atenção</p>'.
                            '<p>Sem conversas de grupo iniciadas</p>'.
                            '<p>Pesquise os seus grupos</p>'.
                            '<p>Ex: Por cadeira / projeto / grupo</p>'.
                            '</div>'.
                            '</div>'.
                            '</div>'.
                            '</li>';
                    }else{



                    foreach ($query as $p) {
                        $novo = json_decode($p->isread,true);
                                if($novo[$my_id] == 0 && $p->sender!=$my_id){

                                    $output .=
                                        "<li class='group' id='group".$p->idGroup."' name=''>".
                                        "<span class='pending'></span>" .
                                        "<input type='hidden' id='namegroup".$p->idGroup."' name='custId' value='".$p->name."'>".
                                        "<input type='hidden' id='entity' name='entity' value='group'>".
                                        "<div class='media'>".
                                        "<div class='media-body'>".
                                        "<p>".$p->subjectName."</p>".
                                        "<p><i>".$p->name."</i></p>".
                                        "<p class='name'>Group ".$p->idGroupProject."</p>".
                                        "</div>".
                                        "</div>".
                                        "</li>";
                                }elseif($novo[$my_id] == 1){
                                    $output .=
                                        "<li class='group' id='group".$p->idGroup."' name=''>".
                                        "<input type='hidden' id='namegroup".$p->idGroup."' name='custId' value='".$p->name."'>".
                                        "<input type='hidden' id='entity' name='entity' value='group'>".
                                        "<div class='media'>".
                                        "<div class='media-body'>".
                                        "<p>".$p->subjectName."</p>".
                                        "<p><i>".$p->name."</i></p>".
                                        "<p class='name'>Group ".$p->idGroupProject."</p>".
                                        "</div>".
                                        "</div>".
                                        "</li>";
                            }elseif($novo[$my_id] == 0 && $p->sender==$my_id){
                                    $output .=
                                        "<li class='group' id='group".$p->idGroup."' name=''>".
                                        "<input type='hidden' id='namegroup".$p->idGroup."' name='custId' value='".$p->name."'>".
                                        "<input type='hidden' id='entity' name='entity' value='group'>".
                                        "<div class='media'>".
                                        "<div class='media-body'>".
                                        "<p>".$p->subjectName."</p>".
                                        "<p><i>".$p->name."</i></p>".
                                        "<p class='name'>Group ".$p->idGroupProject."</p>".
                                        "</div>".
                                        "</div>".
                                        "</li>";
                                }


                    }
                }
                }
                return Response($output);

            }else{
                if($request->entity == "person") {
                    $users=DB::table('users')->where('name','LIKE','%'.$request->search."%")->orWhere('id','=',$request->search)->get();
                    if($users)
                    {
                        foreach ($users as $key => $user) {

                            $source = Storage::url('profilePhotos/'.$user->photo);
                            $output .=
                                "<li class='user' id='" . $user->id . "' name=''>" .
                                "<input type='hidden' id='name".$user->id."' name='custId' value='" . $user->name . "'>" .
                                "<input type='hidden' id='entity' name='entity' value='person'>" .
                                "<div class='media'>" .
                                "<div class='media-left'>" .
                                "<img src='" . $source . "' alt='' class='media-object'>" .
                                '</div>' .
                                '<div class="media-body">' .
                                '<p class="name">' . $user->name . '</p>' .
                                '</div>' .
                                '</div>' .
                                '</li>';
                        }
                        return Response($output);
                    }

                }elseif($request->entity == "group"){

                    $query = DB::select('SELECT groups.idGroup, groups.idGroupProject, subjects.subjectName, projects.name FROM studentGroups
                    LEFT JOIN groups ON studentGroups.idGroup = groups.idGroup 
                    LEFT JOIN subjects ON groups.idProject = subjects.idSubject
                    LEFT JOIN projects ON groups.idProject = projects.idProject
                    WHERE studentGroups.idStudent = '.$my_id.' AND (subjects.subjectName LIKE "%'.$request->search.'%" OR projects.name LIKE "%'.$request->search.'%" OR groups.idGroupProject LIKE "%'.$request->search.'%")');
                    foreach ($query as $p){
                        $output.=
                            "<li class='group' id=".$p->idGroup." name=".$p->subjectName.">".
                            "<input type='hidden' id='name".$p->idGroup."'  value='".$p->subjectName."'>".
                            "<input type='hidden' id='entity' name='entity' value='group'>" .
                            "<div class='media'>".
                            "<div class='media-left'>".
                            '</div>'.
                            '<div class="media-body">'.
                            '<p>'.$p->subjectName.'</p>'.
                            '<p><i>'.$p->name.'</i></p>'.
                            '<p class="name">Group '.$p->idGroupProject.'</p>'.
                            '<p class="email"></p>'.
                            '</div>'.
                            '</div>'.
                            '</li>';

                    }

                    return Response($output);

                }
                else{
                    $output.=
                    "<p>Not found</p>";
                    return Response($output);

                }
            }
        }
    }
}
