<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class RoleComposer
{
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $platforms = ['' => ''] + config('constants.platforms', []);
        $stored_permissions = [];

        switch ($view->getName()) {
            case 'roles.create':
                break;
            case 'roles.show':
            case 'roles.edit':
                $stored_perm = $view->role->getAllPermissions();
                if ($stored_perm->count() > 0) {
                    $stored_permissions = $stored_perm->pluck('id')->toArray();
                }
                break;
        }

        $all_permissions = Permission::get();
        $permissions = ['web' => [], 'api' => []];
        foreach ($all_permissions as $permission) {
            $mod_perm = Str::getModulePermission($permission->name);
            if ($mod_perm) {
                $permissions[$permission->guard_name][$mod_perm['module']][$mod_perm['permission']] = [
                    'id' => $permission->id,
                    'permission' => $mod_perm['permission'],
                    'checked' => in_array($permission->id, $stored_permissions) ?: false
                ];
            }
        }

        $view->with([
            'platforms' => $platforms,
            'permissions' => $permissions
        ]);
    }
}
