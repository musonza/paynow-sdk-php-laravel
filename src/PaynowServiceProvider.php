<?php

namespace Musonza\Paynow;

use Illuminate\Support\ServiceProvider;
use Paynow\Payments\Paynow;
use Illuminate\Foundation\Application as LaravelApplication;

class PaynowServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->publishes(
            [__DIR__ . '/../config/paynow.php' => config_path()],
            'paynow-config'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/paynow.php',
            'paynow'
        );

        $this->app->singleton('paynow', function ($app) {
            $config = $app->make('config')->get('paynow');
            return new Paynow(
                $config['integration_id'],
                $config['integration_key'],
                $config['return_url'],
                $config['result_url']
            );
        });

        $this->app->alias('paynow', 'Paynow\Payments\Paynow');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ 'paynow', 'Paynow\Payments\Paynow'];
    }
}
