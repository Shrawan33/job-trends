<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Helpers\FunctionHelper;
use App\Models\UserPackage;
use App\Repositories\UserPackageRepository;

class PackageReportDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(UserPackageRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 2;
        $this->setFormParams(route('filter-transaction'));
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

        $dataTable->editColumn('payment_date', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $dataTable->addColumn('employer', function ($model) {
            return $model->employer->company_name ?? '' ;
        });
        $dataTable->addColumn('package', function ($model) {
            return $model->package->title ?? '' ;
        });
        $dataTable->addColumn('amount', function ($model) {
            return $model->package->price ?? '' ;
        });
        $dataTable->rawColumns(['payment_date', 'deleted_at', 'employer', 'package', 'amount']);
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
     * @param \App\Models\Blog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserPackage $model)
    {
        $query = $this->repository->allQuery();
        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);
            if (isset($search['start_date']) && !empty($search['start_date'] && isset($search['end_date']) && !empty($search['end_date']))) {
                $query->where('created_at', '>=', $search['start_date']);
                $query->where('created_at', '=<', $search['end_date']);
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
            'employer' => ['title' => trans('label.employer')],
            'package' => ['title' => trans('label.package_name')],
            'amount' => ['title' => trans('label.amount')],
            'payment_date' => ['title' => trans('label.payment_date'), 'searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'package_reports_datatable_' . time();
    }
}
