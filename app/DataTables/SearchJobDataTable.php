<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Repositories\EmployerJobRepository;
use App\Helpers\FunctionHelper;
use App\Models\EmployerJob;
use Illuminate\Support\Arr;

class SearchJobDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(EmployerJobRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity('search-jobs');
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 3;
        // $ajaxFormUrl = null;

        // if ($this->searchLocation || $this->searchTerm) {
        //     $ajaxFormUrl = url('search-jobs/?keyword=' . $this->searchTerm . '&location=' . $this->searchLocation);
        // }

        // $this->setFormParams($ajaxFormUrl);
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
            $format = $model->jobType ? $model->jobType->title . ' . posted ' . $model->created_at->diffForHumans() : '';
            return $model->created_at ? $format : '';
        });

        $dataTable->editColumn('title', function ($model) {
            return view('components.show_link', ['id' => $model->id, 'text' => $model->title, 'entity' => $this->entity, 'url' => route('job-detail', $model->slug)]);
        });

        $action_view = view()->exists('search_jobs.datatables_actions') ? 'search_jobs.datatables_actions' : 'components.datatables_actions';
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
        $query->withQualification();
        $query->withsearchElement();
        $query->selectRaw('employer_jobs.*,employer_job_qualifications.qualification_id as qualification_id, skills.title as skill_title');

        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);
            if (isset($search['category_id']) && !empty($search['category_id'])) {
                $query->whereIn('category_id', $search['category_id']);
            }
            if (isset($search['salary_id']) && !empty($search['salary_id'])) {
                $query->whereIn('salary_id', $search['salary_id']);
            }
            if (isset($search['experience_id']) && !empty($search['experience_id'])) {
                $query->whereIn('experience_id', $search['experience_id']);
            }
            if (isset($search['qualification_id']) && !empty($search['qualification_id'])) {
                $query->whereIn('qualification_id', $search['qualification_id']);
            }
            if (isset($search['location_id'])) {
                $locations = Arr::where($search['location_id'], function ($value, $key) { return !empty($value); });
                if ($locations) {
                    $query->whereIn('location_id', $search['location_id']);
                }
            }
        }
        $query->where('employer_jobs.deleted_at', null)->where('employer_jobs.is_deleted', 0);
        // if ($this->searchLocation != null) {
        //     $query->where('location_id', $this->searchLocation);
        // }
        // if ($this->searchTerm != null) {
        //     $query->where('company_name', 'LIKE', $this->searchTerm . '%')
        //          ->orWhere('skills.title', 'LIKE', $this->searchTerm . '%');
        // }

        $query = $this->setSearchCriteria($query);

        $query->groupBy('employer_jobs.id');
        // dd($locations, $query->toSql());
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
            'company_name' => ['title' => trans('label.company_name')],
            'company_profile' => ['title' => trans('label.company_profile')],
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
        return 'search_jobs_datatable_' . time();
    }
}
