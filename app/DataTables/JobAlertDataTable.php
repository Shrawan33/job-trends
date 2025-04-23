<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Repositories\JobAlertRepository;
use App\Helpers\FunctionHelper;
use App\Models\JobAlert;

class JobAlertDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(JobAlertRepository $repository)
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
        $dataTable->editColumn('location_id', function ($model) {
            // dd($model->state->title);
            return $model->state->title . ', ' .  $model->location->title ?? '';
            // return $model->location->title $model->state->title ?? '';
        });
        $action_view = view()->exists('job_alerts.datatables_actions') ? 'job_alerts.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EmployerJob $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JobAlert $model)
    {
        $query = $this->repository->allQuery();
        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);

            if (isset($search['searchTerm']) && !empty($search['searchTerm'])) {
                $query->where('search_term', 'LIKE', $search['searchTerm'] . '%');
            }
            if (isset($search['location_id'])) {
                $query->where('location_id', $search['location_id']);
            }
        }
        $query->where('deleted_at', null)->where('is_deleted', 0);
        $query->scopes('currentUser');
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
            'search_term' => ['title' => trans('label.search_term'), 'searchable' => true],
            'location_id' => ['title' => trans('label.employer_view.location'), 'searchable' => true],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'job_alerts_datatable_' . time();
    }
}
