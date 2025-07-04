<?php

namespace App\DataTables;

use App\Models\EmployerJob;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\EmployerJobRepository;
use App\Helpers\FunctionHelper;
use Illuminate\Support\Facades\Auth;

class JobPostingDataTable extends BaseDataTable
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

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at, true, '') : '';
        });

        $dataTable->editColumn('deleted_at', function ($model) {
            return view('components.admin.status', ['id' => $model->id, 'entity' => $this->entity, 'model' => $model])->render();
        });
        $dataTable->editColumn('created_by', function ($model) {
            return  $model->createdByUser->company_name ?? '' ;
        });
        $dataTable->addColumn('jobseeker', function ($model) {
            return $model->apply_job_count ?? 0;
            //  view('employer_jobs.application_track_link', ['id' => $model->id, 'text' => $model->apply_job_count ?? 0, 'route' => route('applicationTrackings.index', $model->id)])->render();
        });
        $dataTable->editColumn('title', function ($model) {
            return  $model->title ?? '';
            // view('components.show_link', ['id' => $model->id, 'text' => $model->title ?? '', 'entity' => $this->entity, 'clone' => true, 'url' => route('job-detail', $model->slug)])->render();
        });
        $dataTable->editColumn('is_featured', function ($model) {
            return view('components.admin.feature_job', ['id' => $model->id, 'entity' => $this->entity, 'model' => $model])->render() ;
        });
        $dataTable->editColumn('category_id', function ($model) {
            return $model->category_id ? view('components.show_ajax_link', ['id' => $model->category_id, 'text' => $model->category->title ?? '', 'entity' => 'categories', 'url' => route('categories.show', $model->category_id)])->render() : $model->category_id;
        });
        $dataTable->editColumn('approval_status', function ($model) {
            return config("constants.approval_status.data.{$model->approval_status}", null);
        });

        $dataTable->rawColumns(['action', 'jobseeker', 'created_at', 'created_by', 'title', 'deleted_at', 'is_featured', 'category_id']);
        $action_view = view()->exists('job_posting.datatables_actions') ? 'job_posting.datatables_actions' : 'components.datatables_actions';
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
        $query->withCategory();
        $query->withEmployer();
        $query->withCount('applyJob');
        $query->withTrashed();

        if (Auth::user()->roles->first()->name == 'mentor') {
            $query->WithJobtype();
            $query->where('job_types.user_id', Auth::user()->id);
        }

        // Apply filters
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

        if (Auth::user()->roles->first()->name == 'mentor') {
            return [
                // 'job_number' => ['title' => trans('label.job_no')],
                'title' => ['title' => trans('label.candidate_profile_title')],
                'created_by' => ['title' => trans('label.employer'), 'name' => 'users.company_name'],
                'created_at' => ['title' => trans('label.posted_on')],

                'deleted_at' => ['title' => trans('label.statusSelect')],
                'approval_status' => ['title' => trans('label.approveStatus')],

                'category_id' => ['title' => trans('label.category'), 'name' => 'categories.title'],
                'meta_title' => ['meta_title' => 'Meta Title']

            ];
        } else {
            return [
                // 'job_number' => ['title' => trans('label.job_no')],
                'title' => ['title' => trans('label.candidate_profile_title')],
                'created_by' => ['title' => trans('label.employer'), 'name' => 'users.company_name'],
                'created_at' => ['title' => trans('label.posted_on')],
                'jobseeker' => ['title' => trans('label.applied_btn'), 'searchable' => false],
                'deleted_at' => ['title' => trans('label.statusSelect')],
                'is_featured' => ['title' => trans('label.is_featured')],
                'category_id' => ['title' => trans('label.category'), 'name' => 'categories.title'],
                'meta_title' => ['meta_title' => 'Meta Title']

            ];
        }

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'job_postings_datatable_' . time();
    }
}
