<?php

namespace App\Http\Controllers;

use App\Video;
use App\User;
use Illuminate\Http\Request;
use Auth;
use File;
use Storage;
use VideoThumbnail;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = Video::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);
        $user = User::with('own_videos')->get();
        // dd($user);
        return view('user.video', compact('videos'));
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
        $upload_file = $request->file('upload_file');
        // $path = Storage::disk('public')->putFile('videos', $request->file('upload_file'));
        $path = Storage::disk('s3')->putFile('videos', $request->file('upload_file'), 'public');
        // return Storage::disk('s3')->url($path);
        /* $image = basename($path).".jpg";
        $thumbnail = VideoThumbnail::createThumbnail(storage_path('app/public/'.$path), storage_path('app/public/thumbnails'), $image, 5, 640, 640);
        // dd($path); */
        // if($thumbnail){
            $save = Video::create([
                'user_id' => Auth::user()->id,
                'filename' => $request->filename,
                'description' => $request->description,
                'path' => $path,
                // 'thumbnail_path' => "thumbnails/".$image,
            ]);
        // }
        return redirect()->action('VideoController@index')->with('status', 'Added new video');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
        return view('show-video', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
        if(Auth::user()->id != $video->user_id){
            return redirect()->route('home')->with('warning', 'Tidak bisa edit video milik orang lain');
        }
        return view('user.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
        if($request->file('upload_file')){
            // $delete = Storage::disk('public')->delete($video->path);
            $delete = Storage::disk('s3')->delete($video->path);
            // $path = Storage::disk('public')->put('videos', $request->file('upload_file'));
            $path = Storage::disk('s3')->put('videos', $request->file('upload_file'));
            $update = Video::find($video->id)->update([
                'filename' => $request->filename,
                'description' => $request->description,
                'path' => $path,
            ]);
        }else{
            $update = Video::find($video->id)->update([
                'filename' => $request->filename,
                'description' => $request->description,
            ]);
        }
        return redirect()->action('VideoController@index')->with('status', 'Success updating video');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
        // $delete_video = Storage::disk('public')->delete($video->path);
        $delete_video = Storage::disk('s3')->delete($video->path);
        $delete_data = Video::find($video->id)->delete();
        return redirect()->action('VideoController@index')->with('status', 'Success deleting video');
    }
}
