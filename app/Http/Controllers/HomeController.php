<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\User;
use Auth;

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
    public function index()
    {
        $videos = Video::with(['video_owner', 'video_comments', 'video_likes' => function ($query){
            $query->where('like_status', 'Y');
        }])->orderBy('created_at', 'desc')->paginate(6);
        // dd($videos);
        return view('home', compact('videos'));
    }

    public function search(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->paginate(6);
        $videos = Video::with('video_owner','video_likes','video_comments')->orderBy('created_at', 'desc')->paginate(6);
        if(isset($request->filter)){
            $filter = $request->filter;
            $users = User::select('id')->whereRaw("LOWER(email) LIKE '%".$filter."%'")->orWhereRaw("LOWER(name) LIKE '%".$filter."%'")->get()->pluck('id');
            $videos = Video::with('video_owner','video_likes','video_comments')->whereRaw("LOWER(filename) LIKE '%".$filter."%'")->orWhereRaw("LOWER(description) LIKE '%".$filter."%'")->orWhereIn('user_id', $users)->orderBy('created_at', 'desc')->paginate(6);
            // dd($videos);
        }
        return view('user.search', compact('users','videos'));
    } 
}
