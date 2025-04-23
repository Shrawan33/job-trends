<?php

namespace App\Repositories;

use App\Models\Report;

/**
 * Class ReportRepository
 * @package App\Repositories
 * @version January 12, 2021, 7:09 am UTC
*/

class ReportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reporter_id',
        'reported_type',
        'reported_id',
        'content'
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
        return Report::class;
    }
}
