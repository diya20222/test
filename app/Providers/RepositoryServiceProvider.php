<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\ChangePasswordContract;
use App\Contracts\VideoContract;
use App\Contracts\SettingContract;


use App\Repositories\ChangePasswordRepository;
use App\Repositories\VideoRepository;
use App\Repositories\SettingRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ChangePasswordContract::class, ChangePasswordRepository::class);
        $this->app->bind(VideoContract::class, VideoRepository::class);
        $this->app->bind(SettingContract::class, SettingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
