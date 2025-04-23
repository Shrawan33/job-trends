<?php

namespace App\Repositories;

use App\Models\Criteria;

/**
 * Class CriteriaRepository
 * @package App\Repositories
 * @version May 27, 2021, 5:46 am UTC
*/

class CriteriaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'title'
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
        return Criteria::class;
    }

    public function criteriaLevelRange()
    {
        for ($i = 1; $i <= config('constants.criteria_max_level', 5); $i++) {
            $levels[$i] = config('constants.criteria_max_prefix', '') . $i;
        }
        return $levels;
    }
}
