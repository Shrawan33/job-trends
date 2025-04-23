<?php

namespace App\Repositories;

use App\Models\State;

/**
 * Class StateRepository
 * @package App\Repositories
 * @version March 11, 2021, 6:02 am UTC
*/

class StateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'title',
        'country_id'
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
        return State::class;
    }
}
