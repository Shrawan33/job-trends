<?php

namespace Perception\Libraries\Plivo;

use Exception;
use Illuminate\Support\ServiceProvider;
use Plivo\RestClient;

class PlivoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/plivo.php', 'plivo');

        $this->app->bind(Plivo::class, function () {
            $this->ensureConfigValuesAreSet();
            $client = new RestClient(config('plivo.auth_id'), config('plivo.auth_token'));
            return new Plivo($client);
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfig();
        }
    }

    protected function ensureConfigValuesAreSet()
    {
        $mandatoryAttributes = config('plivo');

        foreach ($mandatoryAttributes as $key => $value) {
            if (empty($value)) {
                throw new Exception("Please provide a value for ${key}");
            }
        }
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/plivo.php' => config_path('plivo.php'),
        ], 'plivo-config');
    }
}
