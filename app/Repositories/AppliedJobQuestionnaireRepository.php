<?php

namespace App\Repositories;

use App\Models\AppliedJobQuestionnaire;

/**
 * Class AppliedJobQuestionnaireRepository
 * @package App\Repositories
 * @version March 22, 2021, 9:41 am UTC
*/

class AppliedJobQuestionnaireRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'questionnaire_id',
        'applied_job_id'
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
        return AppliedJobQuestionnaire::class;
    }

    private function prepareInput($items, $applied_job_id)
    {
        $result = [];
        foreach ($items as $value) {
            $result[] = [
                'id' => 0,
                'applied_job_id' => $applied_job_id,
                'questionnaire_id' => $value['questionnaire_id'] ?? null,
                'answer' => $value['answer'] ?? null,
                'option_id' => $value['option_id'] ?? null,
                'is_correct' => $value['is_correct'] ?? false,
            ];
        }
        return $result;
    }

    public function sync($items = [], $applied_job_id = 0)
    {
        if (!empty($items)) {
            $items = $this->prepareInput($items, $applied_job_id);
            foreach ($items as $itemAr) {
                // Update or Create Items
                $this->create($itemAr);
            }
        }
    }
}
