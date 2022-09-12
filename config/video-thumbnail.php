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
        'ffmpeg'  => env('FFMPEG', 'C:\Users\ffmpeg\bin\ffmpeg.exe'),
        'ffprobe' => env('FFPROBE', 'C:\Users\ffmpeg\bin\ffprobe.exe')
    ]
];