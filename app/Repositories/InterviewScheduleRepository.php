<?php

namespace App\Repositories;

use App\Models\InterviewSchedule;

/**
 * Class ApplicationTrackingRepository
 * @package App\Repositories
 * @version January 12, 2021, 7:09 am UTC
*/

class InterviewScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'employer_job_id',
        'users',
        'title',
        'description',
        'datetime'
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
        return InterviewSchedule::class;
    }

    // public function updateOrCreate($user_id,$item){
    //     return $this->model::updateOrCreate(
    //         ['user_id' =>  $user_id],
    //         $item
    //     );
    // }
}
