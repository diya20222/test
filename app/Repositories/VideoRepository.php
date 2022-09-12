<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Pawlox\VideoThumbnail\Facade\VideoThumbnail;
use Illuminate\Support\Facades\Auth;

use App\Models\Video;

use App\Contracts\VideoContract;

class VideoRepository implements VideoContract
{
    public function update($data)
    {
        DB::beginTransaction();
        try {
            $video_id = Video::find($data['id']);
            
            if (isset($data['video'])) {
                // dd(123);
                $video = uploadFile($data['video'], 'video');
                $videoPathName = public_path() . '/storage/video/' . $video_id->getRawOriginal('video');
                if (File::exists($videoPathName)) {
                    File::delete($videoPathName);
                    $data['video']  = $video;
                }
                try {
                    $videoPathName = public_path('storage/video/') . $data['video'];
                    $thumbailName = rand() . '.jpg';
                    $thumbnailPathName = public_path() . '/storage/thumbs/' . $video_id->getRawOriginal('thumbnail');
                    if (File::exists($thumbnailPathName)) {
                        File::delete($thumbnailPathName);
                        $data['thumbnail'] = $thumbailName;
                    }
                    VideoThumbnail::createThumbnail($videoPathName, public_path('storage/thumbs/'), $thumbailName, 2, 1920, 1080);
                } catch (Exception $e) {
                    dd($e);
                }
            } else {
                $data['video'] = $video_id->getRawOriginal('video');
                $data['thumbnail'] = $video_id->getRawOriginal('thumbnail');
            }
            $updateRow = [
                'video_link' => Str::random(11),
                'video_title' => $data['video_title'],
                'description' => $data['description'],
                'tag' => $data['tag'],
                'video' => $data['video'],
                'category_id' => $data['category_id'],
                'published_at' => $data['published_at'],
                'slug' => $data['video_title'],
                'thumbnail' => $data['thumbnail'],
            ];
            
            $res = $video_id->update($updateRow);
            DB::commit();
            return $res;
        } catch (\Throwable $e) {
            Log::info($e);
            DB::rollBack();
        }
    }
    public function upload($data)
    {
        DB::beginTransaction();
        try {
            $video = uploadFile($data['video'], 'video');
            $videoPathName = public_path('storage/video/') . $video;
            $thumbailName = rand() . '.jpg';
            $res = Video::create([
                'user_id' => Auth::user()->id,
                'video_link' => Str::random(11),
                'video_title' => $data['video_title'],
                'description' => $data['description'],
                'tag' => $data['tag'],
                'video' => $video,
                'category_id' => $data['category_id'],
                'published_at' => $data['published_at'],
                'slug' => $data['video_title'],
                'thumbnail' => $thumbailName,
            ]);            
            VideoThumbnail::createThumbnail($videoPathName, public_path('storage/thumbs/'), $thumbailName, 2, 1920, 1080);

            DB::commit();
            return $res;
        } catch (Exception $e) {
            Log::info($e);
            DB::rollBack();
        }
    }

    public function deleteVideo($id)
    {
     
        DB::beginTransaction();
        try {
            $res = Video::find($id);
            // dd($res);
            unlink(public_path() . '/storage/video/' . $res->getRawOriginal('video'));
            unlink(public_path() . '/storage/thumbs/' . $res->getRawOriginal('thumbnail'));
            $res->delete();
            DB::commit();
            return $res;
        } catch (\Throwable $e) {
            Log::info($e);
            DB::rollBack();
        }
    }
}

