<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Helpers\FunctionHelper;
use App\Models\User;
use App\Repositories\UserRepository;

class EmployerReportDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 4;
        $this->setFormParams(route('filter-employers'));
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
        $dataTable->editColumn('deleted_at', function ($model) {
            return  $model->deleted_at == null ? 'Active' : 'Inactive';
        });
        $dataTable->addColumn('name', function ($model) {
            return $model->company_name ;
        });
        $dataTable->addColumn('is_paid', function ($model) {
            return $model->isPaymentCompleted() ? 'Paid' : 'Free' ;
        });
        $dataTable->rawColumns(['created_date', 'deleted_at', 'name', 'is_paid']);
        return $dataTable;
    }

    public function html()
    {
        $this->getFormParams();

        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax($this->ajaxFormUrl, $this->formDataScript)
            // ->ajaxWithForm($this->ajaxFormUrl, $this->formSelector)
            ->removeColumn(['width' => '170px', 'printable' => false, 'title' => 'Actions'])
            ->parameters([
                'searching' => false,
                'autoWidth' => false,
                'dom' => "<'d-flex justify-content-between'tr>" .
                    "<'d-flex justify-content-between'lip>",
                'stateSave' => false,
                'order' => [[$this->orderColumnNo, $this->orderBy]],
                'buttons' => [
                    ['extend' => 'excel', 'className' => 'btn btn-default btn-sm no-corner', ],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner', ],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner', ],
                ],
                'responsive' => false,
                'language' => [
                    'infoFiltered' => '(Total: _MAX_)',
                ],
                'drawCallback' => $this->drawCallback
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = $this->repository->allQuery()->withTrashed();
        $query->withRole();
        $query->selectRaw('model_has_roles.*,users.*');
        $query->where('role_id', 2);
        $query->groupBy('users.id');

        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);

            if (isset($search['is_paid']) && !empty($search['is_paid'])) {
                //Free Employer
                if ($search['is_paid'] == 1) {
                    $query->whereDoesntHave('payment');
                }
                //Paid Employer
                if ($search['is_paid'] == 2) {
                    $query->whereHas('payment');
                }
            }
            if (isset($search['start_date']) && !empty($search['start_date'] && isset($search['end_date']) && !empty($search['end_date']))) {
                $query->where('created_at', '>', $search['start_date']);
                $query->where('created_at', '<', $search['end_date']);
            }
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
        return [
            'id' => ['title' => trans('label.id')],
            'name' => ['title' => trans('label.name')],
            'deleted_at' => ['title' => trans('label.statusSelect')],
            'is_paid' => ['title' => trans('label.is_paid'), 'searchable' => false],
            'created_at' => ['title' => trans('label.created_date'), 'searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'employer_reports_datatable_' . time();
    }
}
