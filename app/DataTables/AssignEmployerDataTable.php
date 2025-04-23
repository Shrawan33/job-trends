<?php

namespace App\DataTables;

use App\Helpers\FunctionHelper;
use App\Models\AssignEmployer;
use App\Repositories\AssignEmployerRepository;
use Yajra\DataTables\EloquentDataTable;

class AssignEmployerDataTable extends BaseDataTable
{
    public function __construct(AssignEmployerRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity('employer');
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 1;

        $this->setFormParams(route('ajax.employers'));
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

        $dataTable->editColumn('employer_id', function ($model) {
            return view('components.show_ajax_link', ['id' => $model->employer_id, 'text' => $model->employer->company_name ?? '', 'entity' => $this->entity])->render();
            // return $model->employer->company_name ?? null;
        });
        $dataTable->filterColumn('employer_id', function ($query, $keyword) {
            $query->orWhereRaw("company_name like '$keyword%'");
        });

        $dataTable->rawColumns(['action', 'employer_id']);

        $action_view = view()->exists('account_dashboard.employer.datatables_actions') ? 'account_dashboard.employer.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AssignEmployer $model)
    {
        $query = $this->repository->allQuery();
        $query->withEmployer();
        $query->selectRaw('assign_employer.*,users.company_name');
        $query->where('account_manager_id', auth()->user()->id);
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
            'employer_id' => ['title' => trans('label.employer')],
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
        return 'assign_employer_' . time();
    }
}
