<?php

namespace App\Providers;

use App\Chat;
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

        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        view()->composer('*', function ($view)
        {
            $my_id = Auth::id();


            $mu = DB::table('chats')
                ->where('sender', '=', $my_id)
                ->orWhere('receiver', '=', $my_id)
                ->orderBy('Date', 'desc')
                ->pluck('receiver');
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
            //...with this variable
            $view->with('arr_users', $arr_users);
        });
    }
}
