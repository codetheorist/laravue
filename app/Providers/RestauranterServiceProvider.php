<?php

namespace App\Providers;

/**
 * This file is part of Restauranter
 *
 * @license MIT
 * @package Restauranter
 */

use Illuminate\Support\ServiceProvider;
use App\Restauranter;
class RestauranterServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRestauranter();
        $this->registerFacade();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    protected function registerRestauranter()
    {
        $this->app->bind('restauranter', function($app) {
            return new Restauranter($app);
        });
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade() {
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Restauranter', 'App\Facades\Restauranter');
        });
    }

}
