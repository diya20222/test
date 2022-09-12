<?php

namespace Pawlox\VideoThumbnail;

use Illuminate\Support\ServiceProvider;

/**
 * @author     sukhilss <emailtosukhil@gmail.com>
 * @package    Video Thumbnail
 * @version    1.0.0
 */
class VideoThumbnailServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $config = __DIR__.'/Config/video-thumbnail.php';

        $this->publishes([
            $config => config_path('video-thumbnail.php'),
        ], 'video-thumbnail');

        $this->mergeConfigFrom($config, 'video-thumbnail');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('VideoThumbnail', function ($app) {
            return new VideoThumbnail;
        });
    }

}
