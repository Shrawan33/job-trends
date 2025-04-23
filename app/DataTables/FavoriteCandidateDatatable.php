<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Helpers\FunctionHelper;
use App\Models\FavoriteCandidate;
use App\Repositories\FavoriteCandidateRepository;

class FavoriteCandidateDatatable extends BaseDataTable
{
    protected $repository;

    public function __construct(FavoriteCandidateRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 0;
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

        $dataTable->addColumn('name', function ($model) {
            return view('components.user_title', ['model' => $model->user])->render();
        });
        // $dataTable->addColumn('job_post', function ($model) {
        //     // dd($model->appliedJobs);
        //     return view('components.job_post', ['model' => $model->appliedJobs, 'class_a' => 'text-secondary'])->render();
        // });

        $dataTable->addColumn('remark', function ($model) {
            return '<div class="" id="remark_action_' . $model->id . '">' . view('components.remark-button', ['model' => $model, 'class' => 'text-success'])->render() . '</div>';
        });

        $dataTable->addColumn('status', function ($model) {
            return view('components.candidate_status', ['statuses' => config('constants.candidate_status'), 'id' => $model->id, 'selected' => $model->status ?? ''])->render();
        });
        // $dataTable->addColumn('suggested_job_title', function ($model) {
        //     return view('components.suggest_title', ['id' => $model->id, 'suggest' => $model->suggested_title ?? ''])->render();
        // });

        $action_view = view()->exists('shortlisted_candidate.datatables_actions') ? 'shortlisted_candidate.datatables_actions' : 'components.datatables_actions';
        $dataTable->addColumn('action', $action_view);

        return $dataTable->rawColumns(['action', 'name', 'suggested_job_title', 'remark', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FavoriteCandidate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FavoriteCandidate $model)
    {
        $query = $this->repository->allQuery();
        $query->WithFavorite();
        $query->with('appliedJobs');
        $query->selectRaw('favourite_candidates.*, users.first_name,users.last_name, job_seeker_detail.title as job_title');
        // dd($query->toSql());

        $query->where('favourite_candidates.created_by', \Auth::user()->id);
        $query->where('favourite_candidates.user_id', '!=', null);
        $query->where('favourite_candidates.deleted_at', null);
        $query->where('favourite_candidates.is_deleted', 0);

        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);

            if (isset($search['searchTerm']) && !empty($search['searchTerm'])) {
                $query->whereRaw('CONCAT(first_name, last_name) like ?', ["%{$search['searchTerm']}%"]);
            }
            if (isset($search['searchJob']) && !empty($search['searchJob'])) {
                $query->where('job_seeker_detail.title', 'LIKE', $search['searchJob'] . '%');
            }
        }
        $query->where('users.hide_profile', false);
        $query->orderBy('favourite_candidates.created_at', 'DESC');
        $query->groupBy('favourite_candidates.id');
        $this->setSearchCriteria($query);

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $this->getFormParams();

        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax($this->ajaxFormUrl, $this->formDataScript)
            // ->ajaxWithForm($this->ajaxFormUrl, $this->formSelector)
            ->addAction(['width' => '170px', 'printable' => false])
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
            'name' => ['title' => trans('label.name'), 'class' => ''],
            // 'suggested_job_title' => ['title' => trans('label.suggest_job_title'), 'width' => '25%'],
            'remark' => ['title' => trans('label.remark'), 'class' => 'text-nowrap'],
            // 'status' => ['title' => trans('label.statusSelect')],
            // 'job_post' => ['title' => trans('label.job_post'), 'class' => ''],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'favourite_candidates_datatable_' . time();
    }
}
