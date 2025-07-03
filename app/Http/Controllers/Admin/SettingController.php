<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\DataTables\SettingDataTable;
use App\Repositories\SettingRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Throwable;

class SettingController extends AppBaseController
{
    public $repository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->repository = $settingRepo;
        $this->getEntity();
    }

    public function index(SettingDataTable $settingDataTable)
    {
        return $settingDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    public function create(Request $request)
    {
        try {
            $tab = $request->get('tab', 'seo');

        if ($tab === 'google_analytics') {
            $setting = Setting::where('key', 'google_analytics')->first();
            if ($setting) {
                return $this->edit($setting->id);
            }
        }

            $modal = view($this->entity['view'] . '.create', [
                'entity' => $this->entity,
                'tab'    => $tab,
            ])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function store(CreateSettingRequest $request)
    {
        try {
            $input = $request->all();

            // ✅ Handle SEO Setting — multiple per page
            if ($input['key'] === 'seo_setting') {
                $value = json_encode([
                    'meta_title'       => $input['meta_title'] ?? '',
                    'meta_description' => $input['meta_description'] ?? '',
                ]);

                $setting = Setting::updateOrCreate(
                    ['key' => 'seo_setting', 'page' => $input['page']], // unique condition
                    ['value' => $value]
                );
            }

            // ✅ Handle Google Analytics — only one record allowed
            elseif ($input['key'] === 'google_analytics') {
                $value = json_encode([
                    'google_analytics_head'   => $input['google_analytics_head'] ?? '',
                    'google_analytics_body'   => $input['google_analytics_body'] ?? '',
                    'google_analytics_footer' => $input['google_analytics_footer'] ?? '',
                ]);

                $setting = Setting::updateOrCreate(
                    ['key' => 'google_analytics'],
                    [
                        'page'  => null,
                        'value' => $value,
                    ]
                );
            }

            return $this->sendResponse($setting, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }





    public function show($id)
    {
        try {
            $setting = $this->repository->find($id, ['*'], true);

            if (!$setting) {
                return $this->sendError($this->entity['singular'] . ' not found');
            }

            $modal = view($this->entity['view'] . '.show', [
                'setting' => $setting,
                'entity'  => $this->entity,
            ])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function edit($id)
    {
        try {
            $setting = $this->repository->find($id, ['*'], true);

            if (!$setting) {
                return $this->sendError($this->entity['singular'] . ' not found');
            }

            $decoded = $setting->key === 'seo_setting' ? $setting->decoded_value : [];

            $modal = view($this->entity['view'] . '.edit', [
                'setting' => $setting,
                'decoded' => $decoded,
                'entity'  => $this->entity,
            ])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function update($id, UpdateSettingRequest $request)
    {
        try {
            $input = $request->all();

            if ($input['key'] === 'seo_setting') {
                $input['value'] = json_encode([
                    'meta_title'       => (string) ($input['meta_title'] ?? ''),
                    'meta_description' => (string) ($input['meta_description'] ?? ''),
                ]);
            }

            elseif ($input['key'] === 'google_analytics') {
                $input['value'] = json_encode([
                    'google_analytics_head'   => $input['google_analytics_head'] ?? '',
                    'google_analytics_body'   => $input['google_analytics_body'] ?? '',
                    'google_analytics_footer' => $input['google_analytics_footer'] ?? '',
                ]);
            }

            $setting = $this->repository->update([
                'page'  => $input['page'] ?? null,
                'value' => $input['value'],
            ], $id, true);

            return $this->sendResponse($setting, $this->entity['singular'] . ' updated successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }


    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return $this->sendSuccess($this->entity['singular'] . ' deleted successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}
