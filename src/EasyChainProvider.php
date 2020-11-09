<?php

namespace Westeast\EasyChain;

use Illuminate\Support\ServiceProvider;
use Westeast\EasyChain\EasyChain;

class EasyChainProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('easychain', function ($app) {
            $easychain = new EasyChain();
            $config = $app['config'];
            $easychain->config = $config->get('easychain');
            return $easychain;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $dist = __DIR__.'/../config/easychain.php';
        if (function_exists('config_path')) {
            // Publishes config File.
            $this->publishes([
                $dist => config_path('easychain.php'),
            ]);
        }
        $this->mergeConfigFrom($dist, 'easychain');
    }
}
