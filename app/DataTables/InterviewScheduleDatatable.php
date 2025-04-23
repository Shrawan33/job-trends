<?php
namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Helpers\FunctionHelper;
use App\Models\InterviewSchedule;
use App\Models\User;
use App\Repositories\InterviewScheduleRepository;

class InterviewScheduleDatatable extends BaseDataTable
{
    protected $repository;

    public function __construct(InterviewScheduleRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 0;
        $this->setFormParams(route('interviewschedules.index', ['employer_job_id' => request()->employer_job_id, 'user_id' => request()->user_id]));
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

        // $dataTable->editColumn('created_at', function ($model) {
        //     return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at, true, '') : '';
        // });
        $dataTable->editColumn('created_at', function ($model) {
            return $model->created_at ? date('M d, Y', strtotime($model->created_at)) : '';
        });

        $dataTable->filterColumn('title', function ($query, $keyword) {
            return $model->title ?? '';
        });

        $dataTable->editColumn('job_title', function ($model) {
            return $model->employerJob ? view('components.show_link', ['id' => $model->id, 'text' => $model->job_title ?? '', 'entity' => $this->entity, 'clone' => true, 'url' => route('job-detail', $model->employerJob->slug)])->render() : $model->id;
        });

        /*$dataTable->addColumn('interview_link', function ($model) {
            return $model->interview_link ?? '';
        });*/

        $dataTable->addColumn('datetime', function ($model) {
            return date("M d, Y g:i A", strtotime($model->datetime));
        });


        $dataTable->addColumn('name', function ($model) {
            $user_ids = explode(',', $model->users);

            $users = User::select('first_name', 'last_name', 'slug')->whereIn('id', $user_ids)->get();

            $full_names = [];
            foreach ($users as $user) {
                $link = route('candidates.show', ['slug' => $user->slug]);
                $full_name = '<a href="' . $link . '" class="name">' . $user->first_name . ' ' . $user->last_name . '</a>';
                $full_names[] = $full_name;
            }
            return implode(", ", $full_names);
        });


        $dataTable->rawColumns(['action', 'title', 'description', 'created_at', 'datetime', 'name', 'job_title']);

        $action_view = view()->exists('interviewschedules.datatables_actions') ? 'interviewschedules.datatables_actions' : 'components.datatables_actions';
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
        $query->select('interview_schedule.*', 'employer_jobs.title as job_title');
        $query->join('employer_jobs', 'employer_jobs.id', '=', 'interview_schedule.employer_job_id');
        $query->where('employer_jobs.deleted_at', null);
        $query->where('employer_jobs.is_deleted', 0);
        $query->where('interview_schedule.deleted_at', null);
        $query->where('interview_schedule.is_deleted', 0);
        $query->where('interview_schedule.user_id', '!=', null);
        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);
            $searchValues = preg_split('/\s+/', $search['searchTerm'], -1, PREG_SPLIT_NO_EMPTY);
            if (isset($search['searchTerm']) && !empty($search['searchTerm'])) {
                $query->where(function ($q) use ($searchValues) {
                    foreach ($searchValues as $value) {
                        $q->orWhere('interview_schedule.title', 'like', "%{$value}%");
                    }
                });
            }
        }
        $query->where('interview_schedule.created_by', auth()->user()->id);
        if(request()->employer_job_id != 0)
        {
            $query->where('interview_schedule.employer_job_id', request()->employer_job_id);
        }
        if(request()->user_id != 0)
        {
            $query->whereRaw("FIND_IN_SET('" . request()->user_id . "', REPLACE(users,', ',','))");
        }
        $this->setSearchCriteria($query);

        // $this->orderColumnNo = request()->get('best_match', null) == 1 ? 3 : 2;
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
            'name' => ['title' => trans('label.name')],
            'job_title' => ['title' => 'Job Title'],
            'title' => ['title' => 'Interview Title', 'orderable' => false],
           // 'interview_link' => ['title' => trans('Interview Link'), 'orderable' => false],
            'datetime' => ['title' => trans('label.date&time'), 'orderable' => false],
            // 'created_at' => ['title' => trans('label.created_at'), 'searchable' => false, 'orderable' => false],

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
