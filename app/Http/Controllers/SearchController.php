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


                    $mu = DB::table('chats')
                        ->where('sender', '=', $my_id)
                        ->orWhere('receiver', '=', $my_id)
                        ->orderBy('Date', 'desc')
                        ->pluck('sender');
                    $unique = [];
                    foreach ($mu as $m) {
                        array_push($unique, $m);
                    }
                    $mu = array_unique($unique);
                    $arr_users = [];
                    foreach ($mu as $m) {
                        $user_m = User::find($m);
                        array_push($arr_users, $user_m);
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

                    $group = $request->group;

                    $arr_groups = [];

                    $collection = collect([]);
                    $idgroup = collect([]);

                    $unique_ch = [];
                    $fin = [];

                    $cadeiras = collect([]);
                    $estaInscrito = DB::table('subjectEnrollments')->where('idUser', '=', $my_id)->pluck('idSubject');

                    if($estaInscrito){
                        $arr_estaInscrito = [];
                        foreach ($estaInscrito as $cadeira){

                            $subject = DB::table('subjects')->where('idSubject', '=', $cadeira)->pluck('subjectName');

                            $projetos = DB::table('projects')->where('idSubject', '=', $cadeira)->pluck('idProject');

                            foreach ($projetos as $projeto){

                                $groups = DB::table('groups')->where('idProject', '=', $projeto)->pluck('idGroup');

                                foreach ($groups as $group){
                                    $groupChat = DB::table('groupChats')
                                        ->where('sender', '=', $my_id)
                                        ->orderBy('Date', 'desc')
                                        ->pluck('idGroup');
                                    foreach ($groupChat as $m){
                                        array_push($unique_ch, $m);
                                    }
                                    $fin = array_unique($unique_ch);


                                    foreach ($fin as $groupCh){
                                        if ($group == $groupCh){
                                            $idGroupProject = DB::table('groups')
                                                ->where('idGroup', '=', $groupCh)
                                                ->value('idGroupProject');
                                            array_push($arr_groups, $groupCh);
                                            $arr_groups = array_unique($arr_groups);

                                            $groups_n = DB::table('groups')->where('idGroup', '=', $groupCh)->value('idProject');
                                            $projetos_n = DB::table('projects')->where('idProject', '=', $groups_n)->value('idSubject');
                                            $subject_n = DB::table('subjects')->where('idSubject', '=', $projetos_n)->value('subjectName');

                                            $uniques = groupChat::all()->where('idGroup','=',$groupCh);

                                            foreach ($uniques as $um) {
                                                if ($um->isread == 0) {
                                                    $output .=
                                                    "<li class='group' id='group".$groupCh."' name=''>".
                                                    "<span class='pending'></span>" .
                                                    "<input type='hidden' id='namegroup".$groupCh."' name='custId' value='".$idGroupProject."'>".
                                                    "<input type='hidden' id='entity' name='entity' value='group'>".
                                                    "<div class='media'>".
                                                    "<div class='media-left'>".
                                                    "</div>".
                                                    "<div class='media-body'>".
                                                    "<p class='name_gr' style='font-size: 12px;'>Group ".$idGroupProject." - ".$subject_n."</p>".
                                                    "<p class='email'></p>".
                                                    "</div>".
                                                    "</div>".
                                                    "</li>";

                                                } elseif($um->isread == 1){
                                                    $output .=
                                                        "<li class='group' id='group".$groupCh."' name=''>".
                                                        "<input type='hidden' id='namegroup".$groupCh."' name='custId' value='".$idGroupProject."'>".
                                                        "<input type='hidden' id='entity' name='entity' value='group'>".
                                                        "<div class='media'>".
                                                        "<div class='media-left'>".
                                                        "</div>".
                                                        "<div class='media-body'>".
                                                        "<p class='name_gr' style='font-size: 12px;'>Group ".$idGroupProject." - ".$subject_n."</p>".
                                                        "<p class='email'></p>".
                                                        "</div>".
                                                        "</div>".
                                                        "</li>";
                                                }
                                            }

                                        }
                                        return Response($output);


                                        }
                                    }
                                }
                            }
                        }
                    }
            }else{
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

            }

        }
    }
}
