<?php

namespace App\Repositories;

use App\Models\ReviewCategory;
use App\Repositories\BaseRepository;

/**
 * Class ReviewCategoryRepository
 * @package App\Repositories
 * @version June 22, 2023, 1:03 pm UTC
*/

class ReviewCategoryRepository extends BaseRepository
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
        return ReviewCategory::class;
    }
}
