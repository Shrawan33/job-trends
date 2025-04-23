<?php

namespace App\Repositories;

use App\Models\Experience;

/**
 * Class ExperienceRepository
 * @package App\Repositories
 * @version January 18, 2021, 3:09 pm UTC
*/

class ExperienceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'from',
        'to'
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
        return Experience::class;
    }
}
