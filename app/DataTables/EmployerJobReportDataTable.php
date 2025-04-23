<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Helpers\FunctionHelper;
use App\Models\EmployerJob;
use App\Repositories\EmployerJobRepository;

class EmployerJobReportDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(EmployerJobRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 4;
        $this->setFormParams(route('filter-employerjobs'));
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
        $dataTable->editColumn('deleted_at', function ($model) {
            return  $model->deleted_at == null ? 'Active' : 'Inactive';
        });
        $dataTable->editColumn('title', function ($model) {
            return view('components.show_link', ['id' => $model->id, 'text' => $model->title ?? '', 'entity' => $this->entity, 'clone' => true, 'url' => route('job-detail', $model->slug)])->render();
        });
        $dataTable->addColumn('application', function ($model) {
            // return view('employer_jobs.application_track_link', ['id' => $model->id, 'text' => $model->apply_job_count ?? 0, 'route' => route('applicationTrackings.index', $model->id)])->render();
            return $model->apply_job_count ?? 0;
        });
        $dataTable->addColumn('is_paid', function ($model) {
            return $model->isTransactionCompleted() ? 'Paid' : 'Free' ;
        });
        $dataTable->rawColumns(['created_date', 'deleted_at', 'title', 'is_paid', 'application']);
        return $dataTable;
    }

    public function html()
    {
        $this->getFormParams();

        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax($this->ajaxFormUrl, $this->formDataScript)
            // ->ajaxWithForm($this->ajaxFormUrl, $this->formSelector)
            ->removeColumn(['width' => '170px', 'printable' => false, 'title' => 'Actions'])
            ->parameters([
                'searching' => false,
                'autoWidth' => false,
                'dom' => "<'d-flex justify-content-between'tr>" .
                    "<'d-flex justify-content-between'lip>",
                'stateSave' => false,
                'order' => [[$this->orderColumnNo, $this->orderBy]],
                'buttons' => [
                    ['extend' => 'excel', 'className' => 'btn btn-default btn-sm no-corner', ],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner', ],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner', ],
                ],
                'responsive' => false,
                'language' => [
                    'infoFiltered' => '(Total: _MAX_)',
                ],
                'drawCallback' => $this->drawCallback
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Blog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(EmployerJob $model)
    {
        $query = $this->repository->allQuery();
        // $query->scopes('currentUser');
        $query->withCount('applyJob');
        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);

            if (isset($search['is_paid']) && !empty($search['is_paid'])) {
                //Free Job
                if ($search['is_paid'] == 1) {
                    $query->whereDoesntHave('transaction.userPackage');
                }
                //Paid Job
                if ($search['is_paid'] == 2) {
                    $query->whereHas('transaction.userPackage');
                }
            }

            if (isset($search['start_date']) && !empty($search['start_date'] && isset($search['end_date']) && !empty($search['end_date']))) {
                $query->where('created_at', '>', $search['start_date']);
                $query->where('created_at', '<', $search['end_date']);
            }
        }
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
            'id' => ['title' => trans('label.id')],
            'title' => ['title' => trans('label.name')],
            'application' => ['title' => trans('label.applied_btn'), 'searchable' => false],
            'deleted_at' => ['title' => trans('label.statusSelect')],
            'is_paid' => ['title' => trans('label.is_paid'), 'searchable' => false],
            'created_at' => ['title' => trans('label.created_date'), 'searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'employerjob_reports_datatable_' . time();
    }
}
