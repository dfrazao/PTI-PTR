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

            if (Auth::check() == true) {

                $mu = DB::select('select m.*
                                    from chats m
                                    where m.id in (select max(m.id) as max_id
                                                   from chats m
                                                   WHERE m.sender = ' . $my_id . ' or m.receiver = ' . $my_id . '
                                                   group by least(m.receiver, m.sender), greatest(m.receiver, m.sender))
                                                   order by m.Date DESC');
            }else{
                $mu = DB::select('select m.*
                                    from chats m
                                    where m.id in (select max(m.id) as max_id
                                                   from chats m
                                                   WHERE m.sender = 1 or m.receiver = 1
                                                   group by least(m.receiver, m.sender), greatest(m.receiver, m.sender))
                                                   order by m.Date DESC');
            }

            $users = collect([]);

            foreach ($mu as $m) {

                if($m->sender != $my_id){
                    $user_m = User::find($m->sender);
                    $users->push([
                        'sender' => $user_m->id,
                        'name' => $user_m->name,
                        'photo' => $user_m->photo,
                        'isread' => $m->isread
                    ]);
                }else{
                    $user_m = User::find($m->receiver);
                    $users->push([
                        'sender' => $user_m->id,
                        'name' => $user_m->name,
                        'photo' => $user_m->photo,
                        'isread' => $m->isread
                    ]);
                }


            }

                $collection = collect([]);

                if (Auth::check() == true) {
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
                    $collection->push([
                        'idGroup' => 'n',
                    ]);
                }else{
                    foreach ($query as $p) {
                        $collection->push([
                            'idGroup' => $p->idGroup,
                            'idGroupProject' => $p->idGroupProject,
                            'cadeira' => $p->subjectName,
                            'projectName' => $p->name,

                        ]);
                    }
                }


                }


                $notification_chat = 1;
                $isread = Chat::all()->where('receiver', '=', $my_id)->where('isread', '=', 0)->pluck('sender')->unique();
                if (count($isread) > 0) {
                    $notification_chat = count($isread);
                } else {
                    $notification_chat = 0;
                }


                $view->with('users', $users)->with('notification_chat', $notification_chat)->with('isread', $isread)->with('collection', $collection);
             });
    }
}
