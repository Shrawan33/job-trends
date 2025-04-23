<?php

namespace App\DataTables;

use Yajra\DataTables\EloquentDataTable;
use App\Repositories\MessageRepository;
use App\Helpers\FunctionHelper;
use App\Models\DBNotification;
use Illuminate\Support\Facades\DB;

class MessageDataTable extends BaseDataTable
{
    protected $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = FunctionHelper::getEntity();
    }

    public function getFormParams()
    {
        $this->orderColumnNo = 2;
        $prefix = $this->entity['prefix'] == 'account' ? 'account.' : '';

        $this->setFormParams(route($prefix . 'messages.index'));
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    // public function html()
    // {
    //     $this->getFormParams();

    //     return $this->builder()
    //         ->columns($this->getColumns())
    //         ->minifiedAjax($this->ajaxFormUrl, $this->formDataScript)
    //         // ->ajaxWithForm($this->ajaxFormUrl, $this->formSelector)
    //         ->addAction(['width' => '120px', 'printable' => false, 'class' => 'text-nowrap'])
    //         ->parameters([
    //             'searching' => false,
    //             'dom' => "<'d-flex justify-content-between'tr>" .
    //                 "<'d-flex justify-content-center'p>",
    //             'stateSave' => false,
    //             'order' => [[$this->orderColumnNo, $this->orderBy]],
    //             'buttons' => [
    //                 ['extend' => 'excel', 'className' => 'btn btn-default btn-sm no-corner', ],
    //                 ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner', ],
    //                 ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner', ],
    //             ],
    //             'responsive' => true,
    //             'language' => [
    //                 'infoFiltered' => '(Total: _MAX_)',
    //             ],
    //             'drawCallback' => $this->drawCallback
    //         ]);
    // }
    public function html()
    {
        $this->getFormParams();

        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax($this->ajaxFormUrl, $this->formDataScript)
            // ->ajaxWithForm($this->ajaxFormUrl, $this->formSelector)
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'searching' => false,
                'dom' => "<'d-flex justify-content-between'tr>" .
                    "<'d-flex justify-content-between flex-wrap align-items-center'lip>",
                'stateSave' => false,
                'order' => [[$this->orderColumnNo, $this->orderBy]],
                'buttons' => [
                    ['extend' => 'excel', 'className' => 'btn btn-default btn-sm no-corner', ],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner', ],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner', ],
                ],
                'responsive' => true,
                'language' => [
                    'info' => 'Showing _START_ to _END_ of total _TOTAL_ entries',
                ],
                'drawCallback' => $this->drawCallback
            ]);
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
            return $model->created_at ? FunctionHelper::fromSqlDateTime($model->created_at->toDateTimeString(), true, '') : '';
        });

        $dataTable->editColumn('data', function ($model) {
            // return \Illuminate\Support\Str::limit($model->data['message'], 100, '...');
            // if (strlen($model->data['message']) > 100) {
            //     return view('messages.show_more', ['id' => $model->id, 'content' => $model->data['message'] ?? null])->render();
            // }
            // return $model->data['message'] ?? null;
            //return view('messages.show_more', ['model' => $model, 'user_id' => request()->get('message_type', 2) == 2 ? $model->notifiable_id : $model->sender_id, 'is_btn' => false, 'prefix' => $this->entity['prefix'] == 'account' ? 'account.' : '', 'content' => $model->data['message'] ?? null, 'message_type' => request()->get('message_type', 1)])->render();

            //message_type
            $badge_text = config('constants.message_type.data.' . request()->get('message_type', 1), null);
            if (request()->get('message_type') == 1) {
                return "<span class='recieved'>".$badge_text."</span>";
            } else {
                return "<span class='sent'>".$badge_text."</span>";
            }

        });

        $dataTable->editColumn('user', function ($model) {
            //$badge_text = config('constants.message_type.data.' . request()->get('message_type', 1), null);
            $badge_text = '';
            if (auth()->user()->hasRole('employer')) {
                return view('components.user_title', ['model' => request()->get('message_type', 2) == 2 ? $model->notifiable : $model->actorWithTrashed, 'badge_text' => $badge_text])->render();
            } else {
                return view('components.company_title', ['model' => request()->get('message_type', 2) == 2 ? $model->notifiable : $model->actorWithTrashed, 'badge_text' => $badge_text, 'prefix' => $this->entity['prefix'], ])->render();
            }
        });

        $dataTable->rawColumns(['action', 'user', 'data']);

        $action_view = view()->exists('messages.datatables_actions') ? 'messages.datatables_actions' : 'components.datatables_actions';
        return $dataTable->addColumn('action', $action_view);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Message $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function query(DBNotification $model)
    // {
    //     $query = $this->repository->allQuery();
    //     $query->ofTypes(['SendMessage', 'SendMessageIndividual']);
    //     // dd($query->toSql());
    //     $keyword = request()->get('keyword', null);
    //     $description = request()->get('description', null);

    //     if (request()->get('message_type', 2) == 2) {
    //         $query->with('notifiable');
    //         $query->ofCurrentUser('sender');

    //         if (!empty($keyword)) {
    //             $query->whereHasMorph('notifiable', [\App\Models\User::class], function ($query) use ($keyword) {
    //                 $this->setCondition($query, $keyword);
    //             });
    //         }
    //         $sub_table = "(SELECT MAX(created_at) as latest, inn_notif.`type` AS types FROM notifications AS inn_notif WHERE inn_notif.sender_id = '" . auth()->user()->id . "' AND `inn_notif`.`type` like '%SendMessage%' group by inn_notif.notifiable_id) as latest_notif";
    //         $query->join(DB::raw($sub_table), function ($query) {
    //             $query->on('latest_notif.latest', '=', 'notifications.created_at');
    //         });
    //         $query->groupBy('notifiable_id');
    //     } else {
    //         $query->with('actor');
    //         $query->ofCurrentUser('receiver');

    //         if (!empty($keyword)) {
    //             $query->whereHas('actor', function ($query) use ($keyword) {
    //                 $this->setCondition($query, $keyword);
    //             });
    //         }
    //         $sub_table = "(SELECT MAX(created_at) as latest, inn_notif.`type` AS types FROM notifications AS inn_notif WHERE inn_notif.notifiable_id = '" . auth()->user()->id . "' AND `inn_notif`.`type` like '%SendMessage%' group by inn_notif.sender_id) as latest_notif";
    //         $query->join(DB::raw($sub_table), function ($query) {
    //             $query->on('latest_notif.latest', '=', 'notifications.created_at');
    //         });
    //         $query->groupBy('sender_id');
    //     }

    //     if (!empty($description)) {
    //         $query->where('data', 'like', "%$description%");
    //     }

    //     // dd($query->toSql());
    //     return $query;
    // }
    public function query(DBNotification $model)
    {
        $query = $this->repository->allQuery();
        $query->ofTypes(['SendMessage', 'SendMessageIndividual']);
        // dd($query->toSql());
        $keyword = request()->get('keyword', null);
        $description = request()->get('description', null);

        if (request()->get('message_type', 2) == 2) {
            $query->with('notifiable');
            $query->ofCurrentUser('sender');

            if (!empty($keyword)) {
                $query->whereHasMorph('notifiable', [\App\Models\User::class], function ($query) use ($keyword) {
                    $this->setCondition($query, $keyword);
                });
            }
            $sub_table = "(SELECT MAX(created_at) as latest, inn_notif.`type` AS types FROM notifications AS inn_notif WHERE inn_notif.sender_id = '" . auth()->user()->id . "' AND `inn_notif`.`type` like '%SendMessage%' group by inn_notif.notifiable_id) as latest_notif";
            $query->join(DB::raw($sub_table), function ($query) {
                $query->on('latest_notif.latest', '=', 'notifications.created_at');
            });
            $query->groupBy('notifiable_id');
            $query->orderByRaw('CASE WHEN notifications.read_at IS NULL THEN 0 ELSE 1 END ASC');
        } else {
            $query->with('actor');
            $query->ofCurrentUser('receiver');

            if (!empty($keyword)) {
                $query->whereHas('actor', function ($query) use ($keyword) {
                    $this->setCondition($query, $keyword);
                });
            }
            $sub_table = "(SELECT MAX(created_at) as latest, inn_notif.`type` AS types FROM notifications AS inn_notif WHERE inn_notif.notifiable_id = '" . auth()->user()->id . "' AND `inn_notif`.`type` like '%SendMessage%' group by inn_notif.sender_id) as latest_notif";
            $query->join(DB::raw($sub_table), function ($query) {
                $query->on('latest_notif.latest', '=', 'notifications.created_at');
            });
            $query->groupBy('sender_id');
            $query->orderByRaw('CASE WHEN notifications.read_at IS NULL THEN 0 ELSE 1 END ASC');
        }

        if (!empty($description)) {
            $query->where('data', 'like', "%$description%");
        }

        // dd($query->toSql());
        return $query;
    }

    private function setCondition($query, $keyword)
    {
        if (auth()->user()->hasRole('employer')) {
            $query->whereRaw("CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) like '$keyword%'");
        } else {
            $query->whereRaw("company_name like '$keyword%'");
        }
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
            'user' => ['title' => trans('label.name'), 'class' => 'text-nowrap'],
            // 'data' => ['title' => trans('label.type')],
            'created_at' => ['title' => trans('label.date&time'), 'searchable' => false, 'class' => 'text-nowrap']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'messages_datatable_' . time();
    }
}
