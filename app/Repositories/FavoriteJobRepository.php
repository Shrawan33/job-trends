<?php

namespace App\Repositories;

use App\Models\FavoriteJob;

/**
 * Class FavoriteJobRepository
 * @package App\Repositories
 * @version January 12, 2021, 7:09 am UTC
*/

class FavoriteJobRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'employer_job_id'
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
        return FavoriteJob::class;
    }
}
