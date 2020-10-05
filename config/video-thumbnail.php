<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Binaries
    |--------------------------------------------------------------------------
    |
    | Paths to ffmpeg nad ffprobe binaries
    |
    */

    'binaries' => [
        'ffmpeg'  => env('FFMPEG', 'C:\ffmpeg-4.3.1-2020-09-21-full_build\bin\ffmpeg.exe'),
        'ffprobe' => env('FFPROBE', 'C:\ffmpeg-4.3.1-2020-09-21-full_build\bin\ffprobe.exe')
    ]
];