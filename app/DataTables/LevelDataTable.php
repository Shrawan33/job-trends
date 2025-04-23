<?php

namespace App\DataTables;

use App\Models\Level;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\LevelRepository;
use App\Helpers\FunctionHelper;

class LevelDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(LevelRepository $repository)
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

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $action_view = view()->exists('levels.datatables_actions') ? 'levels.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Level $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Level $model)
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
            'title' => ['title'=>trans('label.title')],
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
        return 'levels_datatable_' . time();
    }
}
