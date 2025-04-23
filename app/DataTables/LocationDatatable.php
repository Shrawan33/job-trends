<?php

namespace App\DataTables;

use App\Models\Location;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\LocationRepository;
use App\Helpers\FunctionHelper;

class LocationDatatable extends BaseDataTable
{
    protected $repository;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 2;
        $this->setFormParams();
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $dataTable->editColumn('state_id', function ($model) {
            return view('components.show_ajax_link', ['id' => $model->id, 'text' => $model->state->title ?? '', 'entity' => $this->entity])->render();
        });

        $dataTable->editColumn('title', function ($model) {
            return view('components.show_ajax_link', ['id' => $model->id, 'text' => $model->title, 'entity' => $this->entity])->render();
        });

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $dataTable->rawColumns(['action', 'title', 'state_id']);

        $action_view = view()->exists('locations.datatables_actions') ? 'locations.datatables_actions' : 'components.datatables_actions';

        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Location $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Location $model)
    {
        $query = $this->repository->allQuery();
        $query->WithState();
        $query->selectRaw('locations.*,states.id as state_id, states.title as stateTitle');
        $this->setSearchCriteria($query);
        return $query;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    public function getColumns()
    {
        return [
            'state_id' => ['title' => trans('label.state'), 'name' => 'states.title'],
            'title' => ['title' => trans('label.title')],
            'created_at' => ['title' => trans('label.created'), 'searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'locations_datatable_' . time();
    }
}
