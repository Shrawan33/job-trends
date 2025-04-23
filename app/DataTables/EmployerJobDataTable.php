<?php

namespace App\DataTables;

use App\Models\EmployerJob;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\EmployerJobRepository;
use App\Helpers\FunctionHelper;

class EmployerJobDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(EmployerJobRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
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

        // $dataTable->orderBy('created_at', 'desc')->editColumn('created_at', function ($model) {
        //     return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at, true, '') : '';
        // });

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at, true, '') : '';
        });

        $dataTable->editColumn('deleted_at', function ($model) {
            return view('components.status', ['id' => $model->id, 'entity' => $this->entity, 'model' => $model])->render();
        });

        $dataTable->editColumn('approval_status', function ($model) {
            return config("constants.approval_status.data.{$model->approval_status}", null);
        });

        $dataTable->addColumn('jobseeker', function ($model) {
            return view('employer_jobs.application_track_link', ['id' => $model->id, 'text' => $model->apply_job_count ?? 0, 'route' => route('applicationTrackings.index', $model->id)])->render();
        });

        $dataTable->addColumn('interview', function ($model) {
            return view('employer_jobs.interview_schedule', ['id' => $model->id, 'text' => $model->interview_schedule_count ?? 0, 'route' => route('interviewschedules.index', ['employer_job_id' => $model->id, 'user_id' => 0])])->render();
        });

        $dataTable->editColumn('title', function ($model) {
            return view('components.show_link', ['id' => $model->id, 'text' => $model->title ?? '', 'entity' => $this->entity, 'clone' => true, 'url' => route('applicationTrackings.index', $model->id)])->render();
        });
        $dataTable->rawColumns(['id','interview','action', 'jobseeker', 'created_at', 'title', 'deleted_at']);
        $action_view = view()->exists('employer_jobs.datatables_actions') ? 'employer_jobs.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EmployerJob $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(EmployerJob $model)
    {
        $query = $this->repository->allQuery();
        $query->scopes('currentUser');
        $query->withCount(['applyJob' => function ($query) {
            $query->whereHas('userWithoutHiddenProfile');
        }]);
        $query->withCount('interviewSchedule');
        $this->setSearchCriteria($query);
        // if (request()->has('search_form')) {
        //     parse_str(request()->get('search_form', ''), $search);

        //     if (isset($search['created_at']) && !empty($search['created_at'])) {
        //         $query->whereDate('created_at', '=', date('Y-m-d', strtotime($search['created_at'])));
        //     }
        // }
        // dd($query->toSql());
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
            // 'id' => ['title' => trans('ID'), 'orderable' => false, 'sorting' => false],
            'title' => ['title' =>  '<span>'.trans('label.candidate_profile_title').'</span>'],
            'deleted_at' => ['title' => trans('label.statusSelect')],
            'approval_status' => ['title' => 'Approval status'],
            'created_at' => ['title' => trans('label.posted_on')],
            'jobseeker' => ['title' => trans('label.application'), 'searchable' => false, 'class' => 'text-center' ],
            'interview' => ['title' => trans('label.interview_schedule'), 'searchable' => false, 'class' => 'text-center', 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'employer_jobs_datatable_' . time();
    }

}
