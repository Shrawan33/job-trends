<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Helpers\FunctionHelper;
use App\Models\FavoriteJob;
use App\Repositories\FavoriteJobRepository;

class FavoriteJobDatatable extends BaseDataTable
{
    protected $repository;

    public function __construct(FavoriteJobRepository $repository)
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
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at, true, '') : '';
        });

        $dataTable->editColumn('job_title', function ($model) {
            return view('components.show_link', ['id' => $model->id, 'text' => $model->job_title ?? '', 'entity' => $this->entity, 'clone' => true, 'url' => route('job-detail', $model->employerJob->slug)])->render();
        });

        $dataTable->addColumn('job_type', function ($model) {
            return $model->category ?? '';
        });

        $dataTable->rawColumns(['action', 'job_title', 'job_type']);

        $action_view = view()->exists('favorite_jobs.datatables_actions') ? 'favorite_jobs.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EmployerJob $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FavoriteJob $model)
    {
        $query = $this->repository->allQuery();

        $query->WithFavorite();

        $query->selectRaw('favorite_jobs.*, empjobs.title as job_title, category.title as category');
        $query->where('empjobs.deleted_at', null)->where('empjobs.is_deleted', 0);
        $query->where('favorite_jobs.user_id', \Auth::user()->id);
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
            'job_title' => ['title' => trans('label.candidate_profile_title'), 'name' => 'empjobs.title', 'searchable' => true],
            'job_type' => ['title' => trans('label.category'), 'name' => 'category.title', 'searchable' => true],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'favorite_jobs_datatable_' . time();
    }
}
