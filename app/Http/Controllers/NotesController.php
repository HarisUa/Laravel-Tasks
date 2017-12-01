<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\User;
use App\Likes;
use App\Notes;
use Auth;

use Illuminate\Support\Facades\Schema;

class NotesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        return view('editor', [
            'list' => '', 
            'type' => 'Note',
            'users' => $users,
            'submit' => 'note.add',
        ]);
    }

public function addnotes(Request $request) {
	$this->validate($request, [
        'title' => 'required|max:20',
        'text' => 'required'
    ]);
    
    $dtime = new \DateTime();
    $dtime = $dtime->createFromFormat("m/d/Y", $request->date);
    $datestamp = $dtime->format('Y-m-d 00:00:00');


    $note = Notes::create([
    	'title' => $request->title,
    	'text' => $request->text,
    	'user_id' => Auth::id(),
        'for_id' => intval($request->for),
        'deadline' => $datestamp,
    ]);

    $fromuser = User::findOrFail(Auth::id())->name;
    $user = User::findOrFail($request->for);

    Mail::send('emails.reminder', ['fromuser' => $fromuser, 'task' => $note], function ($m) use ($user) {
            $m->from('admin@laravel.vagrant', 'New Task');

            $m->to($user->email, $user->name)->subject('New Task For You!');
    });
    
    return redirect()->route('home.my');
}

public function editnotessubm(Request $request) {
    $this->validate($request, [
        'title' => 'required|max:20',
        'text' => 'required'
    ]);
    
    $note = Notes::where('id', $request['id'])->first();
    if (Auth::id() != $note->user_id) {
        return redirect()->route('home');
    }

    $dtime = new \DateTime();
    $dtime = $dtime->createFromFormat("m/d/Y", $request['date']);
    $datestamp = $dtime->format('Y-m-d 00:00:00');

    $note->title = $request['title'];
    $note->text = $request['text'];
    $note->for_id = intval($request['for']);
    $note->deadline = $datestamp;
    $note->update();
    
    return redirect()->route('home.my');
}

public function delnotes($id) {
	$note = Notes::where('id', $id)->first();
    if (Auth::id() != $note->user_id) {
        return redirect()->back();
    }
    $note->delete();
    return redirect()->route('home.my');
}

    public function checkLike($id) {
        $note_id = $id;
        $note = Notes::find($note_id);
        if (!$note) {
            return redirect()->route('home');
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $note_id)->first();
        if ($like) {
            $like->delete();
            return redirect()->route('home');
        } else {
            $like = new Likes();
            $like->user_id = $user->id;
            $like->post_id = $note->id;
            $like->save();
        }
        return redirect()->route('home');
    }

    public function editnotes($id) {
        $note = Notes::where('id', $id)->first();
        $users = User::all();
        if (empty($note) || Auth::id() != $note->user_id) {
            return redirect()->route('home');
        }

        $deadline = new \DateTime($note->deadline);
        $deadline = $deadline->format('m/d/Y');
        
        return view('editor', [
            'list' => $note, 
            'users' => $users,
            'type' => 'Note',
            'submit' => 'note.edit.submit',
            'deadline' => $deadline,
        ]);
    }
}
