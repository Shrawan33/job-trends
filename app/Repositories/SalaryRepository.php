<?php

namespace App\Repositories;

use App\Models\Salary;

/**
 * Class SalaryRepository
 * @package App\Repositories
 * @version January 18, 2021, 3:09 pm UTC
*/

class SalaryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'start',
        'end'
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
        return Salary::class;
    }
}
