<?php

/*
 * Video thumbnail class for implementing FFMpeg Features
 */

namespace Pawlox\VideoThumbnail;

use Illuminate\Http\Request;
use App\Http\Requests;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * @author     sukhilss <emailtosukhil@gmail.com>
 * @package    Video Thumbnail
 * @version    1.0.0
 */
class VideoThumbnail {

    protected $FFMpeg = NULL;
    protected $videoObject = NULL;
    protected $videoURL = NULL;
    protected $storageURL = NULL;
    protected $thumbName = NULL;
    protected $fullFile = NULL;
    protected $height = 240;
    protected $width = 320;
    protected $screenShotTime = 1;

    public function createThumbnail($videoUrl, $storageUrl, $fileName, $second, $width = 640, $height = 480) {
        $this->videoURL = $videoUrl;
        
        $this->storageURL = $storageUrl;
        $this->thumbName = $fileName;        
        $this->fullFile = "{$this->storageURL}/{$this->thumbName}";
        
        $this->screenShotTime = $second;

        $this->width = $width;
        $this->height = $height;

        try {
            $this->create();
            $this->thumbnail();
            $this->resizeCropImage($this->width, $this->height, $this->fullFile, $this->fullFile);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return $this;
    }

    public function overlay($overlayPath, $name) {
        try {
            $water_mark = "{$overlayPath}/{$name}";

            $src = imagecreatefrompng($water_mark);
            $tmp = imagecreatefromjpeg($this->fullFile);

            // Set the brush
            imagesetbrush($tmp, $src);

            // Draw a couple of brushes, each overlaying each
            imageline($tmp, imagesx($tmp) / 2, imagesy($tmp) / 2, imagesx($tmp) / 2, imagesy($tmp) / 2, IMG_COLOR_BRUSHED);
            imagejpeg($tmp, $this->fullFile, 100);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function resizeCropImage($max_width, $max_height, $source_file, $dst_dir, $quality = 80) {
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch ($mime) {
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if ($width_new > $width) {
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        } else {
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if ($dst_img)
            imagedestroy($dst_img);
        if ($src_img)
            imagedestroy($src_img);
    }

    private function create() {
        $this->FFMpeg = FFMpeg::create([
            'ffmpeg.binaries'  => config('video-thumbnail.binaries.ffmpeg'),
            'ffprobe.binaries' => config('video-thumbnail.binaries.ffprobe')
        ]);
        $this->videoObject = $this->FFMpeg->open($this->videoURL);
        return $this->videoObject;
    }

    private function resize() {
        $this->videoObject
                ->filters()
                ->resize(new Coordinate\Dimension($this->width, $this->height))
                ->synchronize();
        return $this->videoObject;
    }

    private function thumbnail() {
        $this->videoObject->frame(Coordinate\TimeCode::fromSeconds($this->screenShotTime))->save($this->fullFile);
        return $this->videoObject;
    }

}