<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Helpers\FunctionHelper;
use App\Models\ApplyJob;
use App\Repositories\ApplyJobRepository;

class ApplicationTrackingDatatable extends BaseDataTable
{
    protected $repository;

    public function __construct(ApplyJobRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 3;
        $this->setFormParams(route('applicationTrackings.index', request()->employer_job_id));
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
            return $model->created_at ? date('M d, Y', strtotime($model->created_at)) : '';
        });

        $dataTable->addColumn('name', function ($model) {
            $link = route('candidates.show', ['slug' => $model->user->slug]);
            $name = $model->user->full_name ?? '';
            return '<a href="' . $link . '" class="name">' . $name . '</a>';
        });

        $dataTable->filterColumn('name', function ($query, $keyword) {
            $query->whereRaw('CONCAT(users.first_name, " ", users.last_name) like ?', ["%{$keyword}%"]);
        });


        // $dataTable->addColumn('name', function ($model) {
        //     return view('components.show_link', ['id' => $model->user->id, 'text' => $model->user->full_name ?? '', 'entity' => 'candidates'])->render();
        // });

        $dataTable->filterColumn('name', function ($query, $keyword) {
            $query->whereRaw('CONCAT(users.first_name, users.last_name) like ?', ["%{$keyword}%"]);
        });
        $dataTable->addColumn('location', function ($model) {
            return $model->user->seekerDetail->location->title ?? '';
        });

        $dataTable->addColumn('jobname', function ($model) {
            return $model->employerJob->title ?? '';
        });

        $dataTable->addColumn('status', function ($model) {
            return view('components.candidate_status', ['statuses' => config('constants.candidate_status'), 'id' => $model->id, 'selected' => $model->status ?? ''])->render();
        });

        $dataTable->rawColumns(['action', 'location', 'name', 'created_at', 'jobname', 'status']);

        $action_view = view()->exists('application_trackings.datatables_actions') ? 'application_trackings.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ApplyJob $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ApplyJob $model)
    {
        $query = $this->repository->allQuery();
        $query->withJobSeeker()->withEmployerJob();
        $query->selectRaw('applied_jobs.*,employer_jobs.title, job_seeker_detail.location_id');
        $query->where('applied_jobs.employer_job_id', request()->employer_job_id);
        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);

            if (isset($search['searchTerm']) && !empty($search['searchTerm'])) {
                $query->whereRaw('CONCAT(first_name, last_name) like ?', ["%{$search['searchTerm']}%"]);
            }
            if (isset($search['location_id']) && !empty($search['location_id'])) {
                $query->where('job_seeker_detail.location_id', $search['location_id']);
            }
        }
        $query->where('applied_jobs.deleted_at', null);
        $query->where('applied_jobs.is_deleted', 0);
        $query->where('applied_jobs.user_id', '!=', null);
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
            ->addAction(['width' => '120px', 'printable' => false, 'title' => 'Actions'])
            ->parameters([
                'searching' => false,
                'dom' => "<'d-flex justify-content-between'tr>" .
                    "<'d-flex justify-content-between'lip>",
                'stateSave' => false,
                'order' => [[$this->orderColumnNo, $this->orderBy]],
                'buttons' => [
                    ['extend' => 'excel', 'className' => 'btn btn-default btn-sm no-corner', ],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner', ],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner', ],
                ],
                'responsive' => true,
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
            'name' => ['title' => trans('label.name')],
            'location' => ['title' => trans('label.employer_view.city')],
            'status' => ['title' => trans('label.statusSelect'), 'sorting' => false],
            'created_at' => ['title' => trans('label.applied_on'), 'searchable' => false],
            // 'action' => ['title' => 'Question Response',''],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'application_trackings_datatable_' . time();
    }
}
