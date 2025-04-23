<?php

namespace App\DataTables;

use App\Models\UserReview;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\UserReviewRepository;
use App\Helpers\FunctionHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UsersReviewDatatable extends BaseDataTable
{
    protected $repository;

    public function __construct(UserReviewRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 3;
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
        $dataTable->editColumn('review_from_id', function ($model) {
            // dd($model->review_type);
            if ($model->review_type == 2) {
                return $model->reviewFromUser->first_name ?? '' . ' ' . $model->reviewFromUser->last_name ?? '';
            } elseif ($model->review_type == 1 && $model->reviewFromUser->company_name === null) {
                return $model->reviewFromUser->first_name ?? '' . ' ' . $model->reviewFromUser->last_name ?? '';
            } else {
                return $model->reviewFromUser->company_name ?? '';
            }
        });

        $dataTable->editColumn('review_from_id1', function ($model) {
            // dd($model->review_type);
            if ($model->review_type == 2) {
                return $model->reviewFromUser->first_name ?? '' . ' ' . $model->reviewFromUser->last_name ?? '';
            } elseif ($model->review_type == 1 && $model->reviewFromUser->company_name === null) {
                return $model->reviewFromUser->first_name ?? '' . ' ' . $model->reviewFromUser->last_name ?? '';
            } else {
                return $model->reviewFromUser->company_name ?? '';
            }
        });
        $dataTable->editColumn('review_to_id', function ($model) {
            return  $model->reviewToUser->first_name ?? '' . ' ' . $model->reviewToUser->last_name ?? '';
        });

        $dataTable->editColumn('review_type', function ($model) {
            return  config('constants.review_type.' . $model->review_type);
        });

        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString()) : '';
        });

        $dataTable->rawColumns(['action', 'reviewFromUser.company_name', 'review_to_id','review_from_id','review_from_id1']);

        $action_view = view()->exists('review_user.datatables_actions') ? 'review_user.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserReview $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(UserReview $model)
    {
        //DB::enableQuerylog();
        $query = $this->repository->allQuery();
        $query->ofEmployeeName();
        $query->select('user_reviews.*');

        $query->leftJoin('users as from_users', 'from_users.id', '=', 'user_reviews.review_from_id');
        $query->leftJoin('users as to_users', 'to_users.id', '=', 'user_reviews.review_to_id');

        // Extract search parameters
        parse_str(request()->get('search_form', ''), $search);

        if (!empty($search['review_type'] ?? false)) {
            $query->where('review_type', $search['review_type']);
        }


        if (!empty($search['keyword'])) {
            $keyword = '%' . strtolower($search['keyword']) . '%';
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('reviewFromUser', function ($q) use ($keyword) {
                    $q->whereRaw('LOWER(first_name) LIKE ? OR LOWER(company_name) LIKE ?', [$keyword, $keyword]);
                })->orWhereHas('reviewToUser', function ($q) use ($keyword) {
                    $q->whereRaw('LOWER(first_name) LIKE ? OR LOWER(company_name) LIKE ?', [$keyword, $keyword]);
                });
            });
        }
        //dd($search);
        if (!empty($search['start_date']) && !empty($search['end_date'])) {
            $start_date = FunctionHelper::toSqlDate($search['start_date'], false);
            $end_date = FunctionHelper::toSqlDate($search['end_date'], false);
            $query->where('user_reviews.created_at', '>=', Carbon::parse($search['start_date'])->startOfDay())
                ->where('user_reviews.created_at', '<=', Carbon::parse($search['end_date'])->endOfDay());
        }
        //dd(DB::getQueryLog($query->get()));
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
        'review_from_id' => [
            'title' => trans('label.review'),
            'name' => 'from_users.first_name',
        ],
        'review_from_id1' => [
            'title' => trans('label.review'),
            'name' => 'from_users.company_name',
            'visible' => false,
        ],
        'review_to_id' => [
            'title' => trans('label.review_to_id'),
            'name' => 'to_users.first_name',
        ],
        'review_type' => ['title' => trans('label.review_type')],
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
        return 'users_review_datatable_' . time();
    }
}
