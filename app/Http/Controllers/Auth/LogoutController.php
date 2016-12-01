<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;

class LogoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
    *
    * Logut Function
    */
    public function getSignOut() {
        Auth::logout();
        Session::flush(); //clears out all the exisiting sessions
        return Redirect::route('login');
    }
}
