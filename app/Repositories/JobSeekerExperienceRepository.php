<?php

namespace App\Repositories;

use App\Models\JobSeekerExperience;

/**
 * Class UserRepository
 * @package App\Repositories
 */

class JobSeekerExperienceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'company',
        'duration_from',
        'duration_to',
        'role',
        'location',
        'seeker_detail_id',
        'currently_working'
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
        return JobSeekerExperience::class;
    }

    public function prepareInput($items = [], $user_id = 0, $seeker_detail_id = 0)
    {
        $result = [];
        foreach ($items['company'] as $key => $value) {
            if ($value != '') {
                $result[] = [
                    'id' => $items['exp_id'][$key] ?? 0,
                    'user_id' => $user_id ?? null,
                    'company' => $value ?? null,
                    'role' => $items['role'][$key] ?? null,
                    'duration_from' => $items['duration_from'][$key] ?? null,
                    'duration_to' => $items['duration_to'][$key] ?? null,
                    'description' => $items['description'][$key] ?? null,
                    'location' => $items['location'][$key] ?? null,
                    'reference_name' => $items['reference_name'][$key] ?? null,
                    'reference_phone_number' => $items['reference_phone_number'][$key] ?? null,
                    'reference_position' => $items['reference_position'][$key] ?? null,
                    'years_known' => $items['years_known'][$key] ?? null,
                    'from_month' => $items['from_month'][$key] ?? null,
                    'to_month' => $items['to_month'][$key] ?? null,
                    'seeker_detail_id' => $seeker_detail_id,
                    'currently_working' => isset($items['currently_working'][$key]) ? 1 : 0
                ];
            }
        }
        return $result;
    }

    public function syncExperience(array $items, $user_id, $seeker_detail_id = 0)
    {
        $ids = [];
        if (!empty($items['company'])) {
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
