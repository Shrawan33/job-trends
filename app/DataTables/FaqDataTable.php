<?php

namespace App\DataTables;

use App\Models\Faq;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\FaqRepository;
use App\Helpers\FunctionHelper;

class FaqDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(FaqRepository $repository)
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

        $action_view = view()->exists('faqs.datatables_actions') ? 'faqs.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Faq $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Faq $model)
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
            'question' => ['title' => trans('label.question')],
            'answer' => ['title' => trans('label.answer')],
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
        return 'faqs_datatable_' . time();
    }
}
