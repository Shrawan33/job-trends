<?php

namespace App\DataTables;

use App\Models\Certification;
use Yajra\DataTables\EloquentDataTable;
use App\Helpers\FunctionHelper;
use App\Repositories\CertificationRepository;

class CertificationDatatable extends BaseDataTable
{
    protected $repository;

    public function __construct(CertificationRepository $repository)
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

        $dataTable->editColumn('title', function ($model) {
            return view('components.show_ajax_link', ['id' => $model->id, 'text' => $model->title, 'entity' => $this->entity])->render();
        });

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $dataTable->rawColumns(['action', 'title']);

        $action_view = view()->exists('interview_types.datatables_actions') ? 'interview_types.datatables_actions' : 'components.datatables_actions';

        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Certification $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Certification $model)
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
        return 'certifications_datatable_' . time();
    }
}
