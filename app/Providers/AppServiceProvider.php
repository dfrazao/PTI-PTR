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

        //if($this->app->environment('production')) {
            //URL::forceScheme('https');
        //}

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
            $view->with('arr_users', $arr_users);
        });
    }
}
