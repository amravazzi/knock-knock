<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use DB;

class MessageController extends Controller
{

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    //protected $redirectTo = '/message/list';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        //$this->tasks = $tasks;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'title' => 'required|max:255',
          'message' => 'required',
        ]);

        $userId = \Auth::user()->id;
        $currentStatus = DB::table('app_mode')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->first()->status;

        Message::create([
            'title' => $request->title,
            'content' => $request->message,
            'type' => $currentStatus
        ]);

        return redirect('/message/list');
    }
}
