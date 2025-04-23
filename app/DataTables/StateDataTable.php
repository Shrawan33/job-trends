<?php

namespace App\DataTables;

use App\Models\State;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\StateRepository;
use App\Helpers\FunctionHelper;

class StateDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(StateRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 1;
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

        $dataTable->editColumn('country_id', function ($model) {
            return view('components.show_ajax_link', ['id' => $model->id, 'text' => $model->country->name ?? '', 'entity' => $this->entity])->render();
        });

        $dataTable->editColumn('title', function ($model) {
            return view('components.show_ajax_link', ['id' => $model->id, 'text' => $model->title, 'entity' => $this->entity])->render();
        });

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $dataTable->rawColumns(['action', 'title', 'country_id']);

        $action_view = view()->exists('states.datatables_actions') ? 'states.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\State $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(State $model)
    {
        $query = $this->repository->allQuery();

        $query->WithCountry();
        $query->selectRaw('states.*,countries.id as country_id, countries.name as countryTitle');
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
            'country_id' => ['title' => trans('label.country'), 'name' => 'countries.name'],
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
        return 'states_datatable_' . time();
    }
}
