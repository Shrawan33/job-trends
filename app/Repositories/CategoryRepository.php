<?php

namespace App\Repositories;

use App\Models\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version January 12, 2021, 7:09 am UTC
*/

class CategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_id',
        'title',
        'slug',
        'reference_import_id'
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
        return Category::class;
    }
}
