<?php

namespace App\Repositories;

use App\Models\InterviewType;

/**
 * Class InterviewTypeRepository
 * @package App\Repositories
 * @version January 22, 2021, 9:54 am UTC
*/

class InterviewTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'title',
        'created_by',
        'updated_by',
        'is_deleted',
        'deleted_at'
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
        return InterviewType::class;
    }
}
