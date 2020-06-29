<?php

namespace App\Providers;

use App\Chat;
use App\Group;
use App\groupChat;
use App\SubjectEnrollment;
use App\User;
use Auth;
use DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        /*if($this->app->environment('production')) {
            URL::forceScheme('https');
        }*/
//        if($this->app->environment('production')) {
//            URL::forceScheme('https');
//        }

        view()->composer('*', function ($view) {
            $my_id = Auth::id();


//            $mu = DB::table('chats')
//                ->where('sender', '=', $my_id)
//                ->orWhere('receiver', '=', $my_id)
//                ->orderBy('Date', 'desc')
//                ->pluck('sender');

            $mu = DB::select('select m.*
                                from chats m
                                where m.id in (select max(m.id) as max_id
                                                from chats m
                                                group by least(m.receiver, m.sender), greatest(m.receiver, m.sender))
                                                order by m.Date DESC;');
//            $unique = [];
//            foreach ($mu as $m){
//                array_push($unique, $m);
//            }
//            $mu = array_unique($unique);

            $arr_users = [];
            foreach ($mu as $m) {
                if ($m->sender == $my_id) {
                    $user_m = User::find($m->receiver);
                    array_push($arr_users, $user_m);
                } else {
                    $user_m = User::find($m->sender);
                    array_push($arr_users, $user_m);
                }

            }

            $tem = 1;

            foreach ($arr_users as $user) {
                $user_id = User::all()->pluck('id');
                $isread = Chat::all()->where('receiver', '=', $my_id)->where('sender', '=', $user->id)->where('sender', '!=', $my_id);
                $uniques = array();
                foreach ($isread as $c) {
                    $uniques[$c->code] = $c; // Get unique country by code.
                }


                foreach ($uniques as $um) {
                    if ($um->isread == 0) {
                        $tem = 0;
                    }
                }
            }
            //...with this variable
            $collection = collect([]);
            if (Auth::check() == true){
                $query = DB::select('SELECT groups.idGroup, groups.idGroupProject, subjects.subjectName, projects.name FROM studentGroups
                    LEFT JOIN groups ON studentGroups.idGroup = groups.idGroup 
                    LEFT JOIN subjects ON groups.idProject = subjects.idSubject
                    LEFT JOIN projects ON groups.idProject = projects.idProject
                    WHERE studentGroups.idStudent = ' . $my_id);

                foreach ($query as $p) {
                    $collection->push([
                        'idGroup' => $p->idGroup,
                        'idGroupProject' => $p->idGroupProject,
                        'cadeira' => $p->subjectName,
                        'projectName' => $p->name,

                    ]);
            }

            }



            $notification_chat = 1;
            $isread = Chat::all()->where('receiver','=',$my_id)->where('isread','=',0)->pluck('sender');
            if(count($isread) > 0){
                $notification_chat = count($isread);
            }else{
                $notification_chat = 0;
            }


            $view->with('arr_users', $arr_users)->with('notification_chat',$notification_chat)->with('tem',$tem)->with('isread',$isread)->with('collection',$collection);
        });
    }
}
