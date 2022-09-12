<?php
    use App\Models\User;
use App\Models\Video;

if ( ! function_exists('uploadFile'))
    {
        function uploadFile($file, $dir)
        {
            if ($file) {
                $destinationPath =  storage_path('app/public'). DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
              
                $media_image = $file->hashName();
               

                $file->move($destinationPath, $media_image);
                return $media_image;
            }
        }
    }
    
    
    if ( ! function_exists('sliderMainVideo'))
    {
        function sliderMainVideo()
        {
           $slider_main_video =  App\Models\Video::where('category_id',1)->latest()->first();
           $slider_side_video =  App\Models\Video::where('category_id',1)->orderBy('id','desc')->get()->skip(1)->take(2);
           return array('slider_main_video' =>$slider_main_video,
                    'slider_side_video'     => $slider_side_video
        );
        }
    }
    if ( ! function_exists('deatil_side_video'))
    {
        function deatil_side_video()
        {
           
           $deatil_side_video =  App\Models\Video::get()->skip(1)->take(5);
           return array('deatil_side_video'     => $deatil_side_video
        );
        }
    }
    if ( ! function_exists('comedy_videos'))
    {
        function comedy_videos()
        {
            $comedy_videos =  App\Models\Video::where('category_id',3)->latest()->get();
           return array('comedy_videos' => $comedy_videos       
        );
        }
    }
    if ( ! function_exists('sports_videos'))
    {
        function sports_videos()
        {
            $sports_videos =  App\Models\Video::where('category_id',4)->latest()->get();
           return array('sports_videos' => $sports_videos       
        );
        }
    }
    if ( ! function_exists('gaming_videos'))
    {
        function gaming_videos()
        {
            $gaming_videos =  App\Models\Video::where('category_id',2)->latest()->get();
           return array('gaming_videos' => $gaming_videos       
        );
        }
    }
    if ( ! function_exists('animals_videos'))
    {
        function animals_videos()
        {
            $animals_videos =  App\Models\Video::where('category_id',5)->latest()->get();
           return array('animals_videos' => $animals_videos       
        );
        }
    }
    if ( ! function_exists('education_videos'))
    {
        function education_videos()
        {
            $education_videos =  App\Models\Video::where('category_id',6)->latest()->get();
           return array('education_videos' => $education_videos       
        );
        }
    }
    if ( ! function_exists('vehicales_videos'))
    {
        function vehicales_videos()
        {
            $vehicales_videos =  App\Models\Video::where('category_id',7)->latest()->get();
           return array('vehicales_videos' => $vehicales_videos       
        );
        }
    }
    if (! function_exists('graft_videos')) {
        function graft_videos()
        {
            $graft_videos =  App\Models\Video::where('category_id', 8)->latest()->get();
            return array('graft_videos' => $graft_videos
        );
        }
    }
    if ( ! function_exists('category'))
    {
        function category()
        {
            $category =  App\Models\Video::get();
           return array('category' => $category       
        );
        }
    }
