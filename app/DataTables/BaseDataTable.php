<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;

abstract class BaseDataTable extends DataTable
{
    abstract public function getColumns();

    abstract public function getFormParams();

    public $ajaxFormUrl;
    public $formDataScript;
    public $orderColumnNo = 2;
    public $drawCallback = null;
    public $orderBy = 'desc';

    protected function setFormParams($ajaxFormUrl = null)
    {
        $selector = "form#search-{$this->entity['targetModel']}";
        $this->formDataScript = $this->getFormDataScript($selector);
        if (empty($this->ajaxFormUrl)) {
            $this->ajaxFormUrl = !empty($ajaxFormUrl) ? $ajaxFormUrl : route("{$this->entity['url']}.index");
        }
    }
    public function setSearchCriteria($query, $status_table = null, $approvalStatuses = null)
    {
        if (request()->has('search_form')) {
            parse_str(request()->get('search_form', ''), $search);

            if (isset($search['status']) && !empty($search['status'])) {
                $statuses = [];
                $is_deleted = false;

                foreach ($search['status'] as $key => $status) {
                    $statusExist = config('constants.' . $this->entity['view'] . "_status.data.$status", null);
                    if ($statusExist) {
                        unset($search['status'][$key]);
                        array_push($statuses, $status);
                    }
                    if (!$is_deleted && in_array($status, ['archived', 'deleted'])) {
                        $is_deleted = true;
                    }
                }

                if ($is_deleted || empty($search['status'])) {
                    $query->withTrashed();
                }

                if (!empty($search['status'])) {
                    $query->where(function ($query) use ($search) {
                        foreach ($search['status'] as $status) {
                            $state = config("constants.state.data.$status", null);
                            if ($state !== null) {
                                $scope = "of$state";
                                $query->$scope();
                            }
                        }
                    });
                }

                if (!empty($statuses)) {
                    if (empty($status_table)) {
                        $query->whereIn('status', $statuses);
                    } else {
                        $query->whereIn("{$status_table}.status", $statuses);
                    }
                }
            }

        } else {
            $query->ofAll();
        }
        if (!empty($search['approval_status'])) {
            $query->where(function ($query) use ($search) {
                foreach ($search['approval_status'] as $approvalStatus) {
                    switch ($approvalStatus) {
                        case 0:
                            $query->ofPending();
                            break;
                        case 1:
                            $query->ofApproved();
                            break;
                        case 2:
                            $query->ofRejected();
                            break;
                        case 3:
                            $query->ofCanceled();
                            break;
                        // Add additional cases for other approval statuses if needed
                    }
                }
            });
        }

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
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'searching' => false,
                'dom' => "<'d-flex justify-content-between table-responsive'tr>" .
                    "<'d-flex justify-content-between flex-wrap'lip>",
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
     * Set ajax url with data added from form.
     *
     * @param string $url
     * @param string $formSelector
     * @return $this
     */
    public function getFormDataScript($formSelector)
    {
        $script = <<<CDATA
var formData = $("{$formSelector}").find("input, select").serializeArray();
data.search_form = $("{$formSelector}").serialize();
$.each(formData, function(i, obj){
    data[obj.name] = obj.value;
});
CDATA;

        return $script;
    }

    /**
     * Set ajax url with data added from form.
     *
     * @param string $url
     * @return $this
     */
    public function setAjaxFormUrl($url)
    {
        $this->ajaxFormUrl = $url;
    }
}
