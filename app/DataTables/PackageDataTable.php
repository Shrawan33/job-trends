<?php

namespace App\DataTables;

use App\Models\Package;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\PackageRepository;
use App\Helpers\FunctionHelper;

class PackageDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(PackageRepository $repository)
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

        $dataTable->editColumn('price', function ($model) {
            return $model->price !== null ? FunctionHelper::formatPrice($model->price) : null;
        });

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $dataTable->editColumn('is_default', function ($model) {
            return view('components.is_active', ['is_active' => $model->is_default ?? false])->render();
        });

        $action_view = view()->exists('packages.datatables_actions') ? 'packages.datatables_actions' : 'components.datatables_actions';
        $dataTable->addColumn('action', $action_view);

        return $dataTable->rawColumns(['action', 'is_default']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Package $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Package $model)
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
            'price' => ['searchable' => false],
            'is_default' => ['searchable' => false, 'title' => 'Default?'],
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
        return 'packages_datatable_' . time();
    }
}
