<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //block everything in dash.blade.php is going to be block if user hasnt signed in
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_idAnyname = auth()->user()->id; //get the logged in user
        $uuuser = User::find($user_idAnyname); //USER from app\User.php -model //ADD THIS TO top use App\Http\Controllers\User; so it can find User model
        return view('dash')->with('postAKA', $uuuser->postsAnyname);// postsAnyname is the function in app\User.php
    }
}
