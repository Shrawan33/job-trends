<?php

namespace App\Repositories;

use App\Models\Country;

/**
 * Class CountryRepository
 * @package App\Repositories
 * @version Jan 23, 2023, 04:26 pm UTC
*/

class CountryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name'
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
        return Country::class;
    }
}
