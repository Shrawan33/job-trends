<?php

namespace App\Repositories;

use App\Models\UserProfile;

/**
 * Class EmployerJobRepository
 * @package App\Repositories
 * @version January 22, 2021, 11:24 am UTC
*/

class UserProfileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'user_id',
        'position',
        'phone_number',
        'company_name',
        'company_profile',
        'address',
        'company_email',
        'company_phone',
        'company_website',
        'updated_by',
        'created_by',
        'is_deleted',
        'deleted_at',
        'location'
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
        return UserProfile::class;
    }

    public function sync($input = [], $user)
    {
        $userProfile = !empty($user->usersProfile) ? $user->usersProfile : $this->makeModel();
        $userProfile->fill($input);
        $userProfile->save();
        return $userProfile;
    }
}
