<?php

namespace App\Repositories;

use App\Models\BannerManagement;
use App\Repositories\BaseRepository;

/**
 * Class BannerManagementRepository
 * @package App\Repositories
 * @version March 1, 2021, 1:21 pm UTC
*/

class BannerManagementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'title',
        'tag_line',
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
        return BannerManagement::class;
    }
}
