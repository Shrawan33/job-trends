<?php

namespace App\Repositories;

use App\Models\Questionnaire;

/**
 * Class QuestionnaireRepository
 * @package App\Repositories
 * @version March 19, 2021, 12:34 pm UTC
*/

class QuestionnaireRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'employer_job_id',
        'title',
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
        return Questionnaire::class;
    }

    private function prepareInput($items, $job_id)
    {
        $result = [];
        foreach ($items as $value) {
            if ($value['title'] != '') {
                $result[] = [
                    'id' => $value['id'] ?? 0,
                    'employer_job_id' => $job_id ?? null,
                    'title' => $value['title'] ?? null,
                ];
            }
        }
        return $result;
    }

    public function sync($items = [], $job_id = 0)
    {
        $ids = [];
        if (!empty($items)) {
            $items = $this->prepareInput($items, $job_id);
            foreach ($items as $itemAr) {
                // Update or Create Items
                $item = $this->updateOrCreate($itemAr);
                array_push($ids, $item->id);
            }
        }
        // Remove Items
        $this->deleteByType($ids, $job_id, 'employer_job_id');
    }
}
