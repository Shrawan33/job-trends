<?php

namespace App\DataTables;

use App\Helpers\FunctionHelper;
use App\Models\Industry;
use App\Repositories\IndustryRepository;
use Yajra\DataTables\EloquentDataTable;

class IndustryDataTable extends BaseDataTable
{
    protected $indusrtyRepository;

    public function __construct(IndustryRepository $indusrtyRepository)
    {
        $this->indusrtyRepository = $indusrtyRepository;
        $this->entity = FunctionHelper::getEntity('industries');
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

        $dataTable->editColumn('title', function ($model) {
            return view('components.show_ajax_link', ['id' => $model->id, 'text' => $model->title, 'entity' => $this->entity])->render();
        });

        // $dataTable->editColumn('parent_category', function ($model) {
        //     return $model->parent_category ?? null;
        // });

        $dataTable->rawColumns(['action', 'title', 'parent']);

        $action_view = view()->exists('industries.datatables_actions') ? 'industries.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Industry $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Industry $model)
    {
        $query = $this->indusrtyRepository->allQuery();
        $query->withParent();

        $query->selectRaw('industries.*, parent.title as parent_industry');

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
            // 'parent_category' => ['searchable' => true, 'name' =>  'parent.title', 'title' => trans('label.parent')],
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
        return 'industries_datatable_' . time();
    }
}
