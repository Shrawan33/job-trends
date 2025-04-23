<?php

namespace Perception\Libraries\Kaleyra;

use Exception;
use Illuminate\Support\ServiceProvider;
use Perception\Libraries\Kaleyra\Rest\Client;

class KaleyraServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/kaleyra.php', 'kaleyra');

        $this->app->bind(Kaleyra::class, function () {
            $this->ensureConfigValuesAreSet();
            $client = new Client(config('kaleyra.api_key'), config('kaleyra.sid'), config('kaleyra.domain'), config('kaleyra.sender'), config('kaleyra.source'));
            return new Kaleyra($client);
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
        $mandatoryAttributes = config('kaleyra');

        foreach ($mandatoryAttributes as $key => $value) {
            if (empty($value)) {
                throw new Exception("Please provide a value for ${key}");
            }
        }
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/kaleyra.php' => config_path('kaleyra.php'),
        ], 'kaleyra-config');
    }
}
