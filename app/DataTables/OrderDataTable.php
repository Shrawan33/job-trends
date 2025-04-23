<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\OrderRepository;
use App\Helpers\FunctionHelper;
use App\Models\OrderHeader;
use App\Repositories\OrderDetailRepository;

class OrderDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(OrderDetailRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 5;
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
        $dataTable->addColumn('name', function ($model) {
            $link = route('candidates.show', ['slug' => $model->user->slug]);
            $name = $model->user->full_name ?? '';
            return '<a href="' . $link . '" class="name">' . $name . '</a>';
        });
        $dataTable->editColumn('payment_status', function ($model) {
            return config("constants.payment_status.{$model->payment_status}", 'Pending');
        });
        $dataTable->editColumn('order_process_status', function ($model) {
            return config("constants.order_process_status.{$model->order_process_status}", 'Pending');
        });
        $dataTable->rawColumns(['action', 'name', 'created_at', 'payment_status', 'order_process_status']);
        $action_view = view()->exists('orders.datatables_actions') ? 'orders.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrderHeader $model)
    {
        $query = $this->repository->allQuery();
        $query->WithUser();
        $query->selectRaw('order_headers.*,users.first_name, users.last_name, users.email');
        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);

            if (!empty($search['payment_status'] ?? false)) {
                $query->where('payment_status', $search['payment_status']);
            }
            if (isset($search['start_date']) && !empty($search['start_date']) && isset($search['end_date']) && !empty($search['end_date'])) {
                $query->where('order_headers.created_at', '>=', $search['start_date']);
                $query->where('order_headers.created_at', '<=', $search['end_date']);
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
            'name' => ['title' => trans('label.name')],
            'order_number' => ['title' => trans('label.order_number')],
            'total_amount' => ['title' => trans('label.total_price')],
            'payment_status' => ['title' => trans('label.payment_status')],
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
        return 'orders_datatable_' . time();
    }
}
