<?php

namespace App\Repositories;

use App\Models\Skill;

/**
 * Class SkillRepository
 * @package App\Repositories
 * @version January 18, 2021, 5:19 am UTC
*/

class SkillRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
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
        return Skill::class;
    }
}
