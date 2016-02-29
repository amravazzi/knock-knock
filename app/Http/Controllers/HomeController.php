<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\VisitedPage;

class HomeController extends Controller
{

    public function logNavigation()
    {
        $userId = \Auth::user()->id;
        $currentPage =  '/'.\Route::getCurrentRoute()->getPath();
        $currentPageId = DB::table('pages')->where('page_name', $currentPage)->first()->id;

        return VisitedPage::create([
            'user_id' => $userId,
            'page_id' => $currentPageId
        ]);
    }

    public function verifySequence()
    {
        $userId = \Auth::user()->id;
        $lastSequence = DB::table('visited_pages')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->take(4)->get();

        for($i=3; $i>=0; $i--)
        {
            $seq[3-$i] = $lastSequence[$i]->page_id - 1;
        }

        $userSecret = unserialize(DB::table('users')->where('id', $userId)->first()->sequence);

        if($seq === $userSecret)
        {
          DB::table('app_mode')->insert([
            ['user_id' => $userId, 'status' => 'secret_mode']
          ]);
            return true;
        } else {
            return false;
        }
    }

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
    public function index()
    {
        return view('home');
    }

    /**
     * Show messages list page
     *
     * @return \Illuminate\Http\Response
     */
    public function messageList()
    {
        self::logNavigation();
        self::verifySequence();

        $userId = \Auth::user()->id;
        $currentStatus = DB::table('app_mode')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->first()->status;

        return view('message.list', [
            'messages' => DB::table('messages')->where('type', $currentStatus)->get()
        ]);
    }

    /**
     * Show messages add page
     *
     * @return \Illuminate\Http\Response
     */
    public function messageAdd()
    {
        self::logNavigation();
        self::verifySequence();
        return view('message.add');
    }
}
