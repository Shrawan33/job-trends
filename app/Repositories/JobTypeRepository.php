<?php

namespace App\Repositories;

use App\Models\JobType;
use App\Repositories\BaseRepository;

/**
 * Class JobTypeRepository
 * @package App\Repositories
 * @version March 10, 2023, 9:45 am UTC
*/

class JobTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'is_approval_needed',
        'user_id'
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
        return JobType::class;
    }
}
