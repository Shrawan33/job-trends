<?php

namespace App\Repositories;

use App\Models\QuestionnaireOption;
use App\Repositories\BaseRepository;

/**
 * Class QuestionnaireOptionRepository
 * @package App\Repositories
 * @version March 19, 2021, 12:36 pm UTC
*/

class QuestionnaireOptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'questionnaire_id',
        'title',
        'is_correct',
        'is_deleted',
        'created_by',
        'updated_by'
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
        return QuestionnaireOption::class;
    }
}
