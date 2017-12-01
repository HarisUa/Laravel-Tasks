<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notes;
use App\User;
use Auth;

use Carbon\Carbon;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        //$notes = Notes::latest('id')->where('user_id', '=', Auth::id())->get();
        //$notes = User::find(1)->notes->where('user_id', '=', Auth::id());
        $notes = Notes::all();
        return view('home', ['notes' => $notes, 'userid' => Auth::id(), 'all' => true]);
    }

    public function myindex(Request $req)
    {
        //$notes = Notes::latest('id')->where('user_id', '=', Auth::id())->get();
        $notes = Auth::user()->notes()->get();
        return view('home', ['notes' => $notes, 'userid' => Auth::id(), 'all' => false]);
    }
}
