<?php

namespace App\Repositories;

use App\Models\JobSeekerEducation;

/**
 * Class UserRepository
 * @package App\Repositories
 */

class JobSeekerEducationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'qualification_id',
        'user_id',
        'university',
        'duration_from',
        'duration_to',
        'entitled',
        'location',
        'from_month',
        'to_month',
        'specialization_id',
        'percentile_cgpa',
        'seeker_detail_id'
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
        return JobSeekerEducation::class;
    }

    public function prepareInput($items = [], $user_id = 0, $seeker_detail_id = 0)
    {
        $result = [];
        foreach ($items['qualification_id'] as $key => $value) {
            if ($value != '') {

                $result[] = [
                    'id' => $items['edu_id'][$key] ?? 0,
                    'user_id' => $user_id ?? null,
                    'qualification_id' => $value ?? null,
                    'university' => $items['university'][$key] ?? null,
                    'duration_from' => $items['duration_from'][$key] ?? null,
                    'education_duration_from' => $items['education_duration_from'][$key] ?? null,
                    'duration_to' => $items['duration_to'][$key] ?? null,
                    'education_duration_to' => $items['education_duration_to'][$key] ?? null,
                    'entitled' => $items['entitled'][$key] ?? null,
                    'location' => $items['location'][$key] ?? null,
                    'from_month' => $items['from_month'][$key] ?? null,
                    'to_month' => $items['to_month'][$key] ?? null,
                    'education_from_month' => $items['education_from_month'][$key] ?? null,
                    'education_to_month' => $items['education_to_month'][$key] ?? null,
                    'specialization_id' => $items['specialization_id'][$key] ?? null,
                    'percentile_cgpa' => $items['percentile_cgpa'][$key] ?? null,
                    'seeker_detail_id' => $seeker_detail_id
                ];
                // dd($result);
            }
        }
        return $result;
    }

    public function syncEducation(array $items, $user_id, $seeker_detail_id = 0)
    {
        $ids = [];
        if (!empty($items['qualification_id'])) {
            $items = $this->prepareInput($items, $user_id, $seeker_detail_id);
            foreach ($items as $itemAr) {
                // Update or Create Items
                $item = $this->updateOrCreate($itemAr);
                array_push($ids, $item->id);
            }
        }
        // Remove Items
        $this->deleteByType($ids, $user_id, 'user_id', $seeker_detail_id);
    }

    public function deleteByType($ids, $source_id, $type = 'user_id', $seeker_detail_id = 0)
    {
        $query = $this->model->where($type, $source_id);
        if (!empty($ids)) {
            $query->whereNotIn('id', $ids);
        }
        $query->where('seeker_detail_id', $seeker_detail_id);
        $query->delete();
    }
}
