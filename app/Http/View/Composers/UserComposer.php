<?php

namespace App\Http\View\Composers;

use App\Models\Role;
use App\Repositories\AssignEmployerRepository;
use App\Repositories\UserRepository;
use Illuminate\View\View;

class UserComposer
{
    private $userRepository;
    private $assignEmployerRepository;

    public function __construct(UserRepository $userRepo, AssignEmployerRepository $assignEmployerRepo)
    {
        $this->userRepository = $userRepo;
        $this->assignEmployerRepository = $assignEmployerRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $roleItems = Role::pluck('title', 'name')->toArray();
        $accountManagers = $accountAssign = [];
        $accountAssignIDs = $assignEmployerId = null;
        $response = [];

        if (in_array($view->getName(), ['users.edit', 'profile.fields', 'users.show'])) {
            $roles = $view->user->roles ?? null;
            $view->user->role = $view->user->getRoleNames();
            if (!empty($roles)) {
                $view->user->role_title = $roles->first()->title;
            }
        }
        if ($view->getName() == 'users.load_pdf') {
            $response = $this->userRepository->getCvPdf($view->jobseeker->id);
        }
        if ($view->getName() == 'users.assign_form') {
            $query = $this->userRepository->allQuery();
            $query->withRole();
            $query->where('role_id', 6);
            $accountManagers = $query->get()->pluck('full_name', 'id');
            $accountAssign = $this->assignEmployerRepository->all(['employer_id' => $view->employer->id]);
            if (!empty($accountAssign)) {
                $accountAssignIDs = $accountAssign->pluck('account_manager_id');
                $assignEmployerId = $accountAssign->first()->id ?? 0;
            }
        }
        // dd($roleItems);
        $view->with([
            'roleItems' => ['' => ''] + $roleItems,
            'response' => $response,
            'accountManagers' => $accountManagers,
            'accountAssignIDs' => $accountAssignIDs,
            'assignEmployerId' => $assignEmployerId
        ]);
    }
}
