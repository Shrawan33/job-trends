<?php

namespace App\Repositories;

use App\Models\Qualification;
use App\Repositories\BaseRepository;

/**
 * Class QualificationRepository
 * @package App\Repositories
 * @version January 18, 2021, 3:10 pm UTC
*/

class QualificationRepository extends BaseRepository
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
        return Qualification::class;
    }
}
