<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cari = Like::where('user_id', Auth::user()->id)->where('video_id', $request->video_id)->get()->first();
        if($cari){
            $update = Like::find($cari->id)->update([
                'like_status' => $cari->like_status == 'Y' ? 'T' : 'Y',
            ]);
            $like = Like::find($cari->id);
        }else{
            $like = Like::create([
                'user_id' => Auth::user()->id,
                'video_id' => $request->video_id,
                'like_status' => 'Y',
            ]);

        }
        return response()->json($like, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
        $like = Like::where('id', $like->id)->update([
            'like_status' => $request->current_like,
        ]);
        return response()->json($like, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
