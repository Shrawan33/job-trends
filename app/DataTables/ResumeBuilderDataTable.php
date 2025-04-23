<?php

namespace App\DataTables;

use App\Models\ResumeBuilderController;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\ResumeBuilderRepository;
use App\Helpers\FunctionHelper;
use App\Http\Controllers\Front\ResumeBuilderController as FrontResumeBuilderController;
use App\Models\JobSeekerDetail;
use App\Repositories\JobSeekerDetailRepository;
use Illuminate\Support\Facades\Auth;

class ResumeBuilderDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(JobSeekerDetailRepository $repository)
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

        $dataTable->editColumn('name', function ($model) {
            $text = $model->first_name ." ".$model->last_name;
            return $text;
        });
        $dataTable->rawColumns(['action', 'name', 'created_at']);

        $action_view = view()->exists('resume_builder.datatables_actions') ? 'resume_builder.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ResumeBuilderController $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JobSeekerDetail $model)
    {
        $query = $this->repository->allQuery();
        $query->selectRaw('job_seeker_detail.*');
        $query->where('user_id', Auth::id());
        $query->where('job_seeker_detail.primary_account', 0);
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
            'name' =>  ['title' => 'Name', 'searchable' => true],
            'created_at' => ['title' => 'Created', 'searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'resume_builder_controllers_datatable_' . time();
    }
}
