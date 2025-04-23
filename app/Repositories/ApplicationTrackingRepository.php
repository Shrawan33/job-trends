<?php

namespace App\Repositories;

use App\Models\ApplicationTracking;

/**
 * Class ApplicationTrackingRepository
 * @package App\Repositories
 * @version January 12, 2021, 7:09 am UTC
*/

class ApplicationTrackingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'status',
        'remark'
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
        return ApplicationTracking::class;
    }

    // public function updateOrCreate($user_id,$item){
    //     return $this->model::updateOrCreate(
    //         ['user_id' =>  $user_id],
    //         $item
    //     );
    // }
}
