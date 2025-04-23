<?php

namespace App\DataTables;

use App\Models\Specialization;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\SpecializationRepository;
use App\Helpers\FunctionHelper;

class SpecializationDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(SpecializationRepository $repository)
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

        $dataTable->editColumn('name', function ($model) {
            return view('components.show_ajax_link', ['id' => $model->id, 'text' => $model->name, 'entity' => $this->entity])->render();
        });

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $dataTable->rawColumns(['action','name']);

        $action_view = view()->exists('specializations.datatables_actions') ? 'specializations.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Specialization $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Specialization $model)
    {
        $query = $this->repository->allQuery();
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
            'name' => ['name' => trans('label.name')],
            'created_at' => ['name' => 'created_at', 'searchable' => false]
        ];
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'specializations_datatable_' . time();
    }
}
