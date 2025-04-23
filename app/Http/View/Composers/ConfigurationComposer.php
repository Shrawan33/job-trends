<?php

namespace App\Http\View\Composers;

use App\Repositories\ConfigurationRepository;
use Illuminate\View\View;

class ConfigurationComposer
{
    protected $configurationRepository;

    /**
     * Create a new configuration composer.
     *
     * @param  ConfigurationRepository  $conf
     * @return void
     */
    public function __construct(ConfigurationRepository $conf)
    {
        // Dependencies automatically resolved by service container...
        $this->configurationRepository = $conf;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $models = config('constants.default_configuration_model', []);

        foreach ($models as $type => $fields) {
            $data = $this->configurationRepository->all(['setting_type' => $type]);
            $data->transform(function ($item) {
                $item->updated_user = !empty($item->updatedByUser) ? $item->updatedByUser->name : null;
                return $item;
            });
            if (!empty($fields['label'])) {
                $fields['last_updated_on'] = $data->pluck('updated_at', 'setting_field')->toArray();
                $fields['last_updated_by'] = $data->pluck('updated_user', 'setting_field')->toArray();
                $fields['value'] = $data->pluck('setting_value', 'setting_field')->toArray();
            }

            $view->with($type, $fields);
        }
    }
}
