<?php

namespace App\DataTables;

use App\Helpers\FunctionHelper;
use App\Repositories\UserRepository;
use Yajra\DataTables\EloquentDataTable;

class CandidateDataTable extends BaseDataTable
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 2;

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
            if ($model->hasRole('employer')) {
                $text = $model->company_name ?? '';
            } else {
                $text = $model->full_name ?? '';
            }
            return view('components.show_ajax_link', ['id' => $model->id, 'text' => $text ?? '', 'entity' => $this->entity])->render();
        });
        $dataTable->filterColumn('name', function ($query, $keyword) {
            $query->whereRaw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) like '$keyword%'");
            $query->orWhereRaw("company_name like '$keyword%'");
        });

        $dataTable->orderColumn('name', function ($query, $order) {
            $query->orderBy('first_name', $order);
        });

        $dataTable->rawColumns(['action', 'name']);

        $action_view = view()->exists('mentor_candidates.datatables_actions') ? 'mentor_candidates.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = $this->repository->allQuery();
        $query->withRole();
        $query->selectRaw('model_has_roles.*,users.*');
        $query->where('role_id', 3);
        $query->groupBy('users.id');
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
            'name' => ['title' => trans('label.name')],
            'email' => ['title' => trans('label.email')],

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
        return 'users_' . time();
    }
}
