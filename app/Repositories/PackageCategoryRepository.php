<?php

namespace App\Repositories;

use App\Models\PackageCategory;
use App\Repositories\BaseRepository;

/**
 * Class PackageCategoryRepository
 * @package App\Repositories
 * @version August 16, 2023, 11:14 am UTC
*/

class PackageCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description'
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
        return PackageCategory::class;
    }
}
