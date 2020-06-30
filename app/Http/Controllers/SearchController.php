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

                    $arr_users = [];
                    foreach ($mu as $m){
                        if($m->sender == $my_id){
                            $user_m = User::find($m->receiver);
                            array_push($arr_users, $user_m);
                        }else{
                            $user_m = User::find($m->sender);
                            array_push($arr_users, $user_m);
                        }

                    }


                    foreach ($arr_users as $user) {
                        $user_id = User::all()->pluck('id');
                        $isread = Chat::all()->where('receiver', '=', $my_id)->where('sender', '=', $user->id);
                        $uniques = array();
                        foreach ($isread as $c) {
                            $uniques[$c->code] = $c; // Get unique country by code.
                        }


                        foreach ($uniques as $um) {
                            if ($um->isread == 0) {
                                $source = Storage::url('profilePhotos/' . $user->photo);




                                $output .=
                                    "<li class='user' id='" . $user->id . "' name=''>" .
                                    "<span class='pending'></span>" .
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
                            } else {
                                $source = Storage::url('profilePhotos/' . $user->photo);

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
                        }

                    }
                    return Response($output);


                }elseif ($request->entity == "group"){

                    $collection = collect([]);
                    $query = DB::select('SELECT groupChats.idGroup, groupChats.isread, groups.idGroupProject, subjects.subjectName, projects.name from groupChats
LEFT JOIN groups ON groupChats.idGroup = groups.idGroup 
LEFT JOIN studentGroups ON groupChats.idGroup = studentGroups.idGroup 
LEFT JOIN subjects ON groups.idProject = subjects.idSubject 
LEFT JOIN projects ON groups.idProject = projects.idProject 
WHERE groupChats.id in (SELECT max(groupChats.id) as max_id
                           FROM groupChats
                           GROUP BY groupChats.idGroup) AND studentGroups.idStudent = 1
                           ORDER BY groupChats.Date DESC');
                    foreach ($query as $p) {

                        $novo = json_decode($p->isread,true);

                        foreach ($novo as $key => $one){
                            if($key == $my_id){
                                if($one == 0){
                                    $output .=
                                        "<li class='group' id='group".$p->idGroup."' name=''>".
                                        "<span class='pending'></span>" .
                                        "<input type='hidden' id='namegroup".$p->idGroup."' name='custId' value='".$p->name."'>".
                                        "<input type='hidden' id='entity' name='entity' value='group'>".
                                        "<div class='media'>".
                                        "<div class='media-body'>".
                                        "<p>".$p->subjectName."</p>".
                                        "<p><i>".$p->name."</i></p>".
                                        "<p class='name'>".$p->idGroupProject."</p>".
                                        "</div>".
                                        "</div>".
                                        "</li>";
                                }else{
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
                }
                return Response($output);

            }else{
                if($request->entity == "person") {
                    $users=DB::table('users')->where('name','LIKE','%'.$request->search."%")->get();
                    if($users)
                    {
                        foreach ($users as $key => $user) {

                            $source = Storage::url('profilePhotos/'.$user->photo);
                            $output.=
                                "<li class='user' id=".$user->id." name=".$user->name.">".

                                " <input type='hidden' id='name".$user->id."'  value='".$user->name."'>".
                                "<input type='hidden' id='entity' name='entity' value='person'>" .

                                "<div class='media'>".
                                "<div class='media-left'>".
                                "<img src='".$source."' alt='' class='media-object'>".
                                '</div>'.

                                '<div class="media-body">'.
                                '<p class="name">'.$user->name.'</p>'.
                                '</div>'.
                                '</div>'.
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
                            '<p class="name">'.$p->subjectName.' | '.$p->name.' | Group '.$p->idGroupProject.'</p>'.
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
