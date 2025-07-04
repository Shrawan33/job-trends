<?php

namespace App\DataTables;

use App\Models\Event;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\EventRepository;
use App\Helpers\FunctionHelper;

class EventDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(EventRepository $repository)
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
        $dataTable->editColumn('event_date', function ($model) {
            return $model->event_date ? FunctionHelper::fromSqlDateTime($model->event_date->toDateTimeString()) : '';
        });
        $action_view = view()->exists('events.datatables_actions') ? 'events.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Event $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Event $model)
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
            'event_title' => ['event_title' => trans('label.title')],
            'event_date' => ['event_date' => trans(('label.event_date'))],
            'meta_title' => ['meta_title' => 'Meta Title']
            // 'event_description' => ['event_description' => trans('label.description')],
            // 'createdDate' => ['title' => trans('label.created'), 'searchable' => false],
            // 'created_at' => ['title' => 'Created', 'searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'events_datatable_' . time();
    }
}
