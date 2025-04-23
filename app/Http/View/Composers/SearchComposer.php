<?php

namespace App\Http\View\Composers;

use App\Helpers\FunctionHelper;
use Illuminate\View\View;
use App\Models\Role;
use App\Models\User;

class SearchComposer
{
    private $entity;

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $type = isset($view->type) ? $view->type : null;
        $entity = FunctionHelper::getEntity($type);
        $statusFilter = ['' => config('constants.state.data', [])];
        $approvalstatusFilter = ['status' => config('constants.approval_status.data',[])];
        $RoleFilter = Role::pluck('title', 'id')->toArray();

        $EmployerFilter = User::with(['roles' => function ($q) {
            $q->where('name', 'employer');
        }])->get();

        $EmployerFilter = $EmployerFilter->transform(function ($item, $key) {
            $item->full_name = $item->first_name . ' ' . $item->last_name;

            return  $item;
        })->pluck('full_name', 'id')->toArray();

        return $view->with([
            'approvalstatusFilter' => $approvalstatusFilter,
            'statusFilter' => $statusFilter,
            'entity' => $entity,
            'RoleFilter' => $RoleFilter,
            'EmployerFilter' => $EmployerFilter,
        ]);
    }
}
