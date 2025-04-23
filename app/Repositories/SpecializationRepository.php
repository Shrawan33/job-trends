<?php

namespace App\Repositories;

use App\Models\Specialization;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SpecializationRepository
 * @package App\Repositories
 * @version May 10, 2023, 11:55 am UTC
*/

class SpecializationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Specialization::class;
    }

}
