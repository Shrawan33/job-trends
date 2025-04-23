<?php

namespace App\Repositories;

use App\Models\EmployerJobWorkType;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployerJobWorkTypeRepository
 * @package App\Repositories
 * @version January 22, 2021, 11:24 am UTC
*/

class EmployerJobWorkTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'employer_job_id',
        'work_type_id',
        'updated_by',
        'created_by',
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
        return EmployerJobWorkType::class;
    }

    public function syncByWorkType(array $items = [], Model $seekerDetail)
    {
        return $seekerDetail->workType()->sync($items);

    }
}
