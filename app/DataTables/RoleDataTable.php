<?php

namespace App\DataTables;

use App\Helpers\FunctionHelper;
use App\Repositories\RoleRepository;
use Yajra\DataTables\EloquentDataTable;

class RoleDataTable extends BaseDataTable
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->entity = FunctionHelper::getEntity('roles');
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 3;
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

        $dataTable->editColumn('guard_name', function ($model) {
            return config("constants.platforms.{$model->guard_name}", null);
        });

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $dataTable->addColumn('action', 'roles.datatables_actions');

        return $dataTable->rawColumns(['title', 'guard_name', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = $this->roleRepository->allQuery();

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
            'name' => ['title' => trans('label.roles')],
            'title' => ['title' => trans('label.title')],
            'guard_name' => ['title' => trans('label.platform')],
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
        return 'roles_' . time();
    }
}
