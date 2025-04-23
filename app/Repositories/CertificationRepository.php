<?php

namespace App\Repositories;

use App\Models\Certification;

/**
 * Class CertificationRepository
 * @package App\Repositories
 * @version January 22, 2021, 9:54 am UTC
*/

class CertificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'title',
        'reference_import_id',
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
        return Certification::class;
    }
}
