<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Helpers\FunctionHelper;
use App\Models\InterviewSchedule;
use App\Models\User;
use App\Repositories\InterviewScheduleRepository;

class InterviewDatatable extends BaseDataTable
{
    protected $repository;

    public function __construct(InterviewScheduleRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->setFormParams(route('interviews.index'));
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
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at, true, '') : '';
        });

        $dataTable->filterColumn('title', function ($query, $keyword) {
            return $model->title ?? '';
        });

        $dataTable->editColumn('job_title', function ($model) {
            return $model->job_title ?? '';
        });

        $dataTable->editColumn('datetime', function ($model) {
            return date('M d, Y g:i A', strtotime($model->datetime));
        });

        $dataTable->rawColumns(['action', 'title', 'description', 'created_at', 'datetime', 'job_title']);

        $action_view = view()->exists('interviews.datatables_actions') ? 'interviews.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\InterviewSchedule $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(InterviewSchedule $model)
    {
        $query = $this->repository->allQuery();
        $query->select('interview_schedule.*', 'employer_jobs.title as job_title', 'interview_schedule.datetime');
        $query->join('employer_jobs', 'employer_jobs.id', '=', 'interview_schedule.employer_job_id');
        $query->where('employer_jobs.deleted_at', null);
        $query->where('employer_jobs.is_deleted', 0);
        $query->where('interview_schedule.deleted_at', null);
        $query->where('interview_schedule.is_deleted', 0);
        $query->whereRaw('FIND_IN_SET(?,interview_schedule.users)', auth()->user()->id);
        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);
            if (isset($search['searchTerm']) && !empty($search['searchTerm'])) {
                $query->whereRaw('employer_jobs.title like ?', ["%{$search['searchTerm']}%"]);
            }
            if (isset($search['interview_title']) && !empty($search['interview_title'])) {
                $query->whereRaw('interview_schedule.title like ?', ["%{$search['interview_title']}%"]);
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
            ->addAction(['width' => '120px', 'printable' => false, 'title' => trans('label.action')])
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
                'responsive' => false,
                'language' => [
                    'infoFiltered' => '(Total: _MAX_)',
                    'zeroRecords' => trans('label.no_data_found'),
                    'lengthMenu' => trans('label.show_entries'),
                    'infoEmpty' => trans('label.table_info'),
                    'info' => trans('label.table_info'),
                    'paginate' => [
                        'first' => 'First',
                        'last' => 'Last',
                        'previous' => \trans('label.previous'),
                        'next' => \trans('label.next'),
                    ]
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
            'job_title' => ['title' => trans('label.candidate_profile_title')],
            'title' => ['title' => trans('label.interview_title')],
           // 'interview_link' => ['title' => trans('Interview Link'), 'orderable' => false],
            'datetime' => ['title' => trans('label.date&time')],
            // 'created_at' => ['title' => trans('label.created_at'),'searchable' => false],
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
