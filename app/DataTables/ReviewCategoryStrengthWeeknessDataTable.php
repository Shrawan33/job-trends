<?php

namespace App\DataTables;

use App\Models\ReviewCategoryStrengthWeekness;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\ReviewCategoryStrengthWeeknessRepository;
use App\Helpers\FunctionHelper;

class ReviewCategoryStrengthWeeknessDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(ReviewCategoryStrengthWeeknessRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 1;
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

        $dataTable->editColumn('review_category_type', function ($model) {
            return config("constants.review_category_type.{$model->review_category_type}", null);
        });

        $dataTable->editColumn('badge_id', function ($model) {
            return $model->badge->title ?? '';
        });



        $action_view = view()->exists('review_category_strength_weeknesses.datatables_actions') ? 'review_category_strength_weeknesses.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReviewCategoryStrengthWeekness $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ReviewCategoryStrengthWeekness $model)
    {
        $query = $this->repository->allQuery();
        $query->with('badge');
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
            'badge_id' => ['title' => 'Badge'],
            'review_category_type',
            'title',
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
        return 'review_category_strength_weeknesses_datatable_' . time();
    }
}
