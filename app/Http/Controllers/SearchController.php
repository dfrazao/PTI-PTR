<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
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
            $users=DB::table('users')->where('name','LIKE','%'.$request->search."%")->get();
            if($users)
            {
                foreach ($users as $key => $user) {

                    $source = Storage::url('profilePhotos/'.$user->photo);

                    $output.=
                    "<li class='user' id=".$user->id.">".
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