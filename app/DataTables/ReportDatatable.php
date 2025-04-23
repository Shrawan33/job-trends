<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Repositories\ReportRepository;
use App\Helpers\FunctionHelper;
use App\Models\Report;

class ReportDatatable extends BaseDataTable
{
    protected $repository;

    public function __construct(ReportRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity('reports-abuses');
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 3;
        $this->setFormParams(route('reports-abuses.typeIndex', request()->report_type));
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

        $dataTable->editColumn('reporter_id', function ($model) {
            return view('components.show_ajax_link', ['id' => $model->id, 'text' => $model->reporter->full_name ?? '', 'entity' => $this->entity])->render();
        });

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $dataTable->editColumn('reported_id', function ($model) {
            if (request()->report_type == 'employerjobs') {
                $text = $model->reported->title ?? '';
            }

            if (request()->report_type == 'employers') {
                $text = $model->reported->full_name ?? '';
            }

            if (request()->report_type == 'jobseekers') {
                $text = $model->reported->full_name ?? '';
            }
            return view('components.show_ajax_link', ['id' => $model->id, 'text' => $text, 'entity' => $this->entity])->render();
        });

        $dataTable->rawColumns(['action', 'reported_id', 'reporter_id', 'created_at']);

        $action_view = view()->exists('reports_abuses.datatables_actions') ? 'reports_abuses.datatables_actions' : 'components.datatables_actions';

        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Report $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Report $model)
    {
        $query = $this->repository->allQuery();
        $query->WithMorph();
        $query->WithRole();
        // $query->WithSearch();
        $query->selectRaw('report_abuses.*,model_has_roles.*, users.first_name, users.last_name, employer_jobs.title');
        if (request()->report_type == 'employerjobs') {
            $query->where('reported_type', 'App\Models\EmployerJob');
        }

        if (request()->report_type == 'employers') {
            $query->where('reported_type', 'App\Models\User');
            $query->where('role_id', 2);
        }

        if (request()->report_type == 'jobseekers') {
            $query->where('reported_type', 'App\Models\User');
            $query->where('role_id', 3);
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
        if (request()->report_type == 'employerjobs') {
            $reported = ['title' => trans('label.reporter_job'), 'name' => 'employer_jobs.title'];
        }
        if (request()->report_type == 'jobseekers') {
            $reported = ['title' => trans('label.reporter_jobseeker'), 'name' => 'users.first_name'];
        }
        if (request()->report_type == 'employers') {
            $reported = ['title' => trans('label.reporter_employer'), 'name' => 'users.first_name'];
        }

        return [
            'reporter_id' => ['title' => trans('label.reporter'), 'name' => 'users.first_name', 'searchable' => true],
            'reported_id' => $reported,
            'content' => ['title' => trans('label.content')],
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
        return 'reports_datatable_' . time();
    }
}
