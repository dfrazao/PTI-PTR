<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public function set($lang) {
        session(['applocale' => $lang]);

        return back();
    }
}
