<?php

namespace App\DataTables;

use App\Models\JobType;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\JobTypeRepository;
use App\Helpers\FunctionHelper;

class JobTypeDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(JobTypeRepository $repository)
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

        $dataTable->editColumn('user_id', function ($model) {

            return $model->user->first_name ?? '-';
        });

        $dataTable->editColumn('is_approval_needed', function ($model) {

            return $model->is_approval_needed ? 'Yes' : 'No';
        });

        $action_view = view()->exists('job_types.datatables_actions') ? 'job_types.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\JobType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JobType $model)
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
            'is_approval_needed' => ['title' => 'Approval Needed'],
            'user_id' => ['title' => 'Approval By'],
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
        return 'job_types_datatable_' . time();
    }
}
