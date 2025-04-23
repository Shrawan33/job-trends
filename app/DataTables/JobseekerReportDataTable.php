<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Helpers\FunctionHelper;
use App\Models\User;
use App\Repositories\UserRepository;

class JobseekerReportDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 3;
        $this->setFormParams(route('filter-jobseekers'));
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
            return $model->full_name ;
        });

        $dataTable->rawColumns(['created_date', 'deleted_at', 'name']);

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Blog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = $this->repository->allQuery()->withTrashed();
        $query->withRole();

        $query->selectRaw('model_has_roles.*,users.*');
        $query->where('role_id', 3);
        $query->groupBy('users.id');
        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);
            if (isset($search['start_date']) && !empty($search['start_date'] && isset($search['end_date']) && !empty($search['end_date']))) {
                $query->where('created_at', '>', $search['start_date']);
                $query->where('created_at', '<', $search['end_date']);
            }
        }
        $this->setSearchCriteria($query);
        return $query;
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
        return 'jobseeker_reports_datatable_' . time();
    }
}
