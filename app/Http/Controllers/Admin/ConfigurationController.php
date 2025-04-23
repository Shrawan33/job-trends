<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateConfigurationRequest;
use App\Repositories\ConfigurationRepository;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\AppBaseController;
use Throwable;
use Illuminate\Support\Str;

class ConfigurationController extends AppBaseController
{
    /** @var  ConfigurationRepository */
    private $configurationRepository;

    public function __construct(ConfigurationRepository $configurationRepo)
    {
        $this->configurationRepository = $configurationRepo;
    }

    /**
     * Show the form for editing the specified Configuration.
     *
     * @param  string $type
     *
     * @return Response
     */
    public function configuration()
    {
        $configurations = $this->configurationRepository->all();

        return view('configurations.edit', compact('configurations'));
    }

    /**
     * Update the specified Configuration in storage.
     *
     * @param UpdateConfigurationRequest $request
     *
     * @return Response
     */
    public function update(Request $request, $type)
    {
        $configuration = $this->configurationRepository->all(['setting_type' => $type]);

        $this->configurationRepository->sync($request->except('_token'), $configuration);

        $configuration_type = ['general' => 'General', 'contact' => 'Contact', 'pricing' => 'Pricing'];

        return $this->sendResponse($configuration, "{$configuration_type[$type]} settings updated successfully.");
    }

    /**
     * Update the specified generated numbers in storage.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function updateGeneratedNumbers(Request $request)
    {
        $requestData = $request->except('_token');

        $generatedNumbers = $this->configurationRepository->updateOrCreateGeneratedNumbers($requestData['configurations']);

        return $this->sendResponse($generatedNumbers, 'Generated numbers updated successfully.');
    }

    /**
     * get pattern preview.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function getPatternPreview(Request $request)
    {
        try {
            $pattern = $request->get('pattern');
            $field = $request->get('name');

            if (!empty($pattern)) {
                $pattern = Str::getNextNumber($field, '0001', $pattern);
            }

            return $this->sendResponse($pattern, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
