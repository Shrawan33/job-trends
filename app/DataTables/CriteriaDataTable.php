<?php

namespace App\DataTables;

use App\Models\Criteria;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\CriteriaRepository;
use App\Helpers\FunctionHelper;

class CriteriaDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(CriteriaRepository $repository)
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

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $action_view = view()->exists('criterias.datatables_actions') ? 'criterias.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Criteria $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Criteria $model)
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
            'title',
            'max_score',
            'created_at' => ['title' => 'Created', 'searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'criterias_datatable_' . time();
    }
}
