<?php

namespace App\Repositories;

use App\Models\WorkType;
use App\Repositories\BaseRepository;

/**
 * Class WorkTypeRepository
 * @package App\Repositories
 * @version January 18, 2021, 10:08 am UTC
*/

class WorkTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return WorkType::class;
    }
}
