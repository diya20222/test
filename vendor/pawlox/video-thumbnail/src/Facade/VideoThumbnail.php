<?php

namespace Pawlox\VideoThumbnail\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @author     sukhilss <emailtosukhil@gmail.com>
 * @package    Video Thumbnail
 * @version    1.0.0
 */
class VideoThumbnail extends Facade {

    protected static function getFacadeAccessor() {
        return 'VideoThumbnail';
    }

}