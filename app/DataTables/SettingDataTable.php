<?php

namespace App\DataTables;

use App\Helpers\FunctionHelper;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Yajra\DataTables\EloquentDataTable;

class SettingDataTable extends BaseDataTable
{
    protected $repository;
    protected $filterKey = 'seo_setting';

    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function setFilterKey(string $key)
    {
        $this->filterKey = $key;
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 1;
        $this->setFormParams();
    }

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        if ($this->filterKey === 'seo_setting') {
            $dataTable->addColumn('meta_title', fn($model) => $model->decoded_value['meta_title'] ?? '');
            $dataTable->addColumn('meta_description', fn($model) => $model->decoded_value['meta_description'] ?? '');
        }

        if ($this->filterKey === 'google_analytics') {
            $dataTable->addColumn('tracking_id', fn($model) => $model->decoded_value['tracking_id'] ?? '');
            $dataTable->addColumn('measurement_id', fn($model) => $model->decoded_value['measurement_id'] ?? '');
        }

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at
                ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString())
                : '';
        });

        $action_view = view()->exists('settings.datatables_actions')
            ? 'settings.datatables_actions'
            : 'components.datatables_actions';

        return $dataTable->addColumn('action', $action_view);
    }

    public function query(Setting $model)
    {
        $query = $this->repository->allQuery()->where('key', $this->filterKey);
        $this->setSearchCriteria($query);
        return $query;
    }

    public function getColumns()
    {
        if ($this->filterKey === 'google_analytics') {
            return [
                'page'           => ['title' => trans('label.page')],
                'tracking_id'    => ['title' => trans('label.tracking_id')],
                'measurement_id' => ['title' => trans('label.measurement_id')],
            ];
        }

        return [
            'page'             => ['title' => trans('Page')],
            'meta_title'       => ['title' => trans('Meta Title')],
            'meta_description' => ['title' => trans('Meta Description')],
        ];
    }

    protected function filename()
    {
        return 'settings_datatable_' . time();
    }
}
