<?php

namespace App\DataTables;

use App\Models\OrderHistory;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\OrderHistoryRepository;
use App\Helpers\FunctionHelper;
use App\Models\OrderHeader;
use App\Repositories\OrderDetailRepository;

class OrderHistoryDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(OrderDetailRepository $repository)
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
        // $dataTable->addColumn('name', function ($model) {
        //     $link = route('candidates.show', ['slug' => $model->user->slug]);
        //     $name = $model->user->full_name ?? '';
        //     return '<a href="' . $link . '" class="name">' . $name . '</a>';
        // });
        $dataTable->editColumn('payment_status', function ($model) {
            return config("constants.payment_status.{$model->payment_status}", 'Pending');
        });
        $dataTable->editColumn('order_process_status', function ($model) {
            return config("constants.order_process_status.{$model->order_process_status}", 'Pending');
        });
        $dataTable->rawColumns(['action', 'created_at', 'payment_status', 'order_process_status']);
        $action_view = view()->exists('order_history.datatables_actions') ? 'order_history.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrderHistory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrderHeader $model)
    {
        $query = $this->repository->allQuery();
        $query->WithUser();
        $query->selectRaw('order_headers.*,users.first_name, users.last_name, users.email');
        $query->where('order_headers.user_id', \Auth::user()->id);

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
            'order_number' => ['title' => trans('label.order_number')],
            'total_amount' => ['title' => trans('label.total_price')],
            'payment_status' => ['title' => trans('label.payment_status'), 'sorting' => false],
            'order_process_status' => ['title' => trans('label.order_process_status'), 'sorting' => false],
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
        return 'order_histories_datatable_' . time();
    }
}
