<?php

namespace App\DataTables;

use App\Helpers\FunctionHelper;
use App\Repositories\UserRepository;
use Yajra\DataTables\EloquentDataTable;

class UserDataTable extends BaseDataTable
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
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
        $dataTable->editColumn('roles', function ($model) {
            return $model->getRoleNames()->count() > 0 ? implode(',', $model->roles->pluck('title')->toArray()) : '';
        });
        $dataTable->editColumn('email_verified_at', function ($model) {
            if ($model->hasRole('employer') || $model->hasRole('jobseeker')) {
                if($model->email_verified_at != "") {
                    return '<i class="fa fa-check" style="color:#32cd32; font-size:24px; text-align:center; width:80%;"></i>';
                } else {
                    return '<i class="fa fa-times" style="color:red; font-size:24px; text-align:center; width:80%;"></i>';
                }
            }
        });
        $dataTable->rawColumns(['action', 'name', 'roles', 'email_verified_at','created_at']);

        $action_view = view()->exists('users.datatables_actions') ? 'users.datatables_actions' : 'components.datatables_actions';
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

        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);

            if (isset($search['role']) && !empty($search['role'])) {
                if ($search['role'][0] == '0') {
                } else {
                    $query->whereIn('role_id', $search['role']);
                }
            }
        }
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
            'roles' => ['searchable' => false, 'title' => trans('label.roles'), 'orderable' => false],
            'email_verified_at' => ['searchable' => false, 'title' => trans('label.verified'), 'orderable' => false],
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
