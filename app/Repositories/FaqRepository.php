<?php

namespace App\Repositories;

use App\Models\Faq;

/**
 * Class FaqRepository
 * @package App\Repositories
 * @version March 3, 2021, 9:48 am UTC
*/

class FaqRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'question',
        'Answer',
        'created_at',
        'updated_at',
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
        return Faq::class;
    }
}
