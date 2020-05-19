<?php
namespace App\Http\Controllers;
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
                $mu = Chat::all()->where('sender', '==', $my_id)->sortByDesc('Date')->pluck('receiver');

//                $mu = DB::table('chats')
//                    ->where('sender', '=', $my_id)
//                    ->orWhere('receiver', '=', $my_id)
//                    ->orderBy('Date', 'desc')
//                    ->get();
//
                $unique = [];
                foreach ($mu as $m){
                    array_push($unique, $m);
                }
                $mu = array_unique($unique);
                $arr_users = [];
                foreach ($mu as $m){
                    $user_m = User::find($m);
                    array_push($arr_users, $user_m);
                }
                foreach ($arr_users as $key => $user) {

                    $source = Storage::url('profilePhotos/'.$user->photo);

                    $output.=
                        "<li class='user' id=".$user->id." name=".$user->name.">".

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
            }else{
                $users=DB::table('users')->where('name','LIKE','%'.$request->search."%")->get();
                if($users)
                {
                    foreach ($users as $key => $user) {

                        $source = Storage::url('profilePhotos/'.$user->photo);
                        $output.=
                            "<li class='user' id=".$user->id." name=".$user->name.">".
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