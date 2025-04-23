<?php

namespace App\DataTables;

use App\Models\ApplyJob;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\ApplyJobRepository;
use App\Helpers\FunctionHelper;
use Illuminate\Support\Facades\Auth;

class ApplyJobDatatable extends BaseDataTable
{
    protected $repository;

    public function __construct(ApplyJobRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity('applyJobs');
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 4;
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
            return $model->created_at ? $model->created_at->format('M d, Y') : '';
        });


        $dataTable->editColumn('job_title', function ($model) {
            return $model->employerJob ? view('components.show_link', ['id' => $model->id, 'text' => $model->job_title ?? '', 'entity' => $this->entity, 'clone' => true, 'url' => route('job-detail', $model->employerJob->slug)])->render() : $model->id;
        });

        $dataTable->editColumn('employer_job_id', function ($model) {
            return $model->employerJob ? view('components.show_link', ['id' => $model->employerJob->id, 'text' => $model->employerJob->createdByUser->company_name ?? '', 'entity' => 'employerJobs', 'url' => route('job-detail.employer.show', $model->employerJob->createdByUser->slug)])->render() : $model->id;
        });
        $dataTable->addColumn('location', function ($model) {
            // dd($model->employerJob);
            return  $model->employerJob->state->title . ', ' .  $model->employerJob->location->title ?? '';
            return $model->employerJob ? $model->employerJob->location->title ?? '' : $model->id;
        });

        $dataTable->rawColumns(['action', 'job_title', 'employer_job_id']);

        $action_view = view()->exists('apply_jobs.datatables_actions') ? 'apply_jobs.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EmployerJob $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function query(ApplyJob $model)
    // {
    //     $query = $this->repository->allQuery();

    //     $query->withJob();

    //     $query->selectRaw('applied_jobs.*, empjobs.title as job_title');
    //     $query->where('applied_jobs.user_id', Auth::user()->id);

    //     if (request()->has('search_form')) {
    //         parse_str(request()->get('search_form', ''), $search);
    //         $searchValues = preg_split('/\s+/', $search['searchTerm'], -1, PREG_SPLIT_NO_EMPTY);
    //         if (isset($search['searchTerm']) && !empty($search['searchTerm'])) {
    //             $query->where(function ($q) use ($searchValues) {
    //                 foreach ($searchValues as $value) {
    //                     $q->orWhere('empjobs.title', 'like', "%{$value}%");
    //                 }
    //             });
    //         }
    //         if (isset($search['location_id']) && !empty($search['location_id'])) {
    //             $query->where('empjobs.location_id', $search['location_id']);
    //         }
    //     }
    //     $query->where('applied_jobs.deleted_at', null);
    //     // $query->groupBy('applied_jobs.employer_job_id');

    //     $this->setSearchCriteria($query);
    //     // dd($query->toSql());
    //     return $query;
    // }

    public function query(ApplyJob $model)
{
    $query = $this->repository->allQuery();

    $query->withJob();

    $query->selectRaw('applied_jobs.*, empjobs.title as job_title');
    $query->where('applied_jobs.user_id', Auth::user()->id);

    if (request()->has('search_form')) {
        parse_str(request()->get('search_form', ''), $search);
        $searchValues = preg_split('/\s+/', $search['searchTerm'], -1, PREG_SPLIT_NO_EMPTY);
        if (isset($search['searchTerm']) && !empty($search['searchTerm'])) {
            $query->where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $q->orWhere('empjobs.title', 'like', "%{$value}%");
                }
            });
        }
        if (isset($search['location_id']) && !empty($search['location_id'])) {
            $query->where('empjobs.location_id', $search['location_id']);
        }
        if (isset($search['candidate_status']) && !empty($search['candidate_status'])) {
            if ($search['candidate_status'] === 'job_apply') {
                $query->where('applied_jobs.status', 'Awaiting Review');
            } else {
                $query->where('applied_jobs.status', $search['candidate_status']);
            }
        }

    } else {
        // If there are no filters, show all data
        $query->where('applied_jobs.deleted_at', null);
    }

    $query->where('applied_jobs.deleted_at', null);

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
            'job_title' => ['title' => trans('label.candidate_profile_title')],
            'employer_job_id' => ['title' => trans('label.employer')],
            'location' => ['title' => trans('label.employer_view.location')],
            'status' => ['title' => trans('label.statusSelect')],
            'created_at' => ['title' => trans('label.applied_on'), 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'apply_jobs_datatable_' . time();
    }
}
