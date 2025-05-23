<?php

namespace Perception\Libraries\Meilisearch\Php;

use Meilisearch\Scout\MeilisearchServiceProvider as PhpMeilisearchServiceProvider;

use Laravel\Scout\EngineManager;
use MeiliSearch\Client;
use Meilisearch\Scout\Console\IndexMeilisearch;
use Meilisearch\Scout\Engines\MeilisearchEngine;

class MeilisearchServiceProvider extends PhpMeilisearchServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../../../config/meilisearch.php', 'meilisearch');

        $this->app->singleton(Client::class, function () {
            return new Client(config('meilisearch.host'), config('meilisearch.key'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../../../config/meilisearch.php' => config_path('meilisearch.php'),
            ], 'config');

            $this->commands([IndexMeilisearch::class]);
        }

        resolve(EngineManager::class)->extend('meilisearch', function () {
            return new MeilisearchEngine(
                resolve(Client::class),
                config('scout.soft_delete', false)
            );
        });
    }
}
