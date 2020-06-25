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

        view()->composer('*', function ($view)
        {
            $my_id = Auth::id();


            $mu = DB::table('chats')
                ->where('sender', '=', $my_id)
                ->orWhere('receiver', '=', $my_id)
                ->orderBy('Date', 'desc')
                ->pluck('sender');


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


                                    $collection->push([
                                            'idGroup' => $groupCh,
                                            'idGroupProject' => $idGroupProject,
                                            'cadeira' => $subject_n,
                                    ]);
                                }
                            }
                        }
                    }
                }


            }


            $notification_chat = 1;
            $isread = Chat::all()->where('receiver','=',$my_id)->where('isread','=',0)->pluck('sender');
            if(count($isread) > 0){
                $notification_chat = count($isread);
            }else{
                $notification_chat = 0;
            }


            $view->with('arr_users', $arr_users)->with('arr_groups',$arr_groups)->with('notification_chat',$notification_chat)->with('tem',$tem)->with('isread',$isread)->with('idgroup',$idgroup)->with('collection',$collection);
        });
    }
}
