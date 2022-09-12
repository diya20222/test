<?php namespace Folour\Flavy\Provider;

/**
 *
 * @author Vadim Bova <folour@gmail.com>
 * @link   http://github.com/folour | http://vk.com/folour
 *
 */

use Folour\Flavy\Flavy;
use Illuminate\Support\ServiceProvider;

class FlavyServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../../../../config/flavy.php';
        $publishPath = config_path('flavy.php');

        $this->publishes([$configPath => $publishPath], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('flavy', function() {
            return new Flavy(config('flavy'));
        });
        $this->app->alias('flavy', 'Folour\Flavy\Flavy');
    }
}