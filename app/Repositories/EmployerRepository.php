<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/**
 * Class EmployerRepository
 * @package App\Repositories
 */

class EmployerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'email',
        'first_name',
        'last_name',
        'company_name',
        'phone_number',
        'hide_profile',
        'created_at',
        'role_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function makeUserContactVerified(int $userId, string $verification)
    {
        $updateData = [];

        switch ($verification) {
            case 'email':
                $updateData['email_verified_at'] = date('Y-m-d H:i:s');
                break;

            case 'phone':
                $updateData['mobile_verified_at'] = date('Y-m-d H:i:s');
                break;
        }

        return $this->model()::whereId($userId)->update($updateData);
    }

    public function search(array $item)
    {
        //dd($item);
        $query = $this->allQuery();
        $query->WithEmployerDetail();
        $query->WithRole();

        $query->selectRaw('users.*, users_profile.company_profile as company_profile, users_profile.address, users_profile.company_email, users_profile.company_website');

        if (isset($item['state_id']) && $item['state_id'] != null) {
            $query->where('users_profile.state_id', '=', $item['state_id']);
        }

		if (isset($item['location_id']) && $item['location_id'] != null) {
            $query->where('users_profile.location_id', '=', $item['location_id']);
        }

		if (isset($item['area_id']) && $item['area_id'] != null) {
            $query->where('users_profile.area_id', '=', $item['area_id']);
        }

        // if (isset($item['company']) && $item['company'] != null) {
        //     $query->where('users.company_name', 'LIKE', "{$item['company']}");
        // }

        if (isset($item['company']) && !empty($item['company'])) {
            $keyword = $item['company'];

            $query->where(function ($query) use ($keyword) {
                $query->where('users.company_name', 'LIKE', "%{$keyword}%");
            });
        }

        $query->where('model_has_roles.role_id', '=', 2); // employer

        $query->whereRaw('users.email_verified_at IS NOT NULL');

        $query->groupBy('users.id');

        $sortby = 'users.created_at DESC';
        if (isset($item['sortby']) && $item['sortby'] != null) {
            if($item['sortby'] == 'oldest')
            {
                $sortby = 'users.created_at ASC';
            }
            elseif($item['sortby'] == 'newest')
            {
                $sortby = 'users.created_at DESC';
            }
        }
        $query->orderByRaw($sortby);

        return $query->paginate(config('constants.pagination.page_no'))->fragment('search');
    }
}
