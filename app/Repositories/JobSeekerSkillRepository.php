<?php

namespace App\Repositories;

use App\Models\JobSeekerSkill;
use App\Models\Skill;
use Throwable;

/**
 * Class UserRepository
 * @package App\Repositories
 */

class JobSeekerSkillRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'skill_id',
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
        return JobSeekerSkill::class;
    }

    public function prepareInput($items = [], $user_id = 0, $seeker_detail_id = 0)
    {
        $result = [];
        foreach ($items['skill_id'] as $key => $value) {
            if ($value != '') {
                if (is_numeric($value) === false) {
                    try {
                        // add new skill
                        $value = Skill::firstOrCreate(['title' => $items['skill_id'][$key] ])->id;
                    } catch (Throwable $e) {
                        continue;
                    }
                }


                $result[] = [
                    'id' => $value ?? 0,
                    'user_id' => $user_id ?? null,
                    'skill_id' => $value ?? null,
                    'seeker_detail_id' => $seeker_detail_id
                ];
            }
        }

        return $result;
    }

    public function syncSkill(array $items, $user_id, $seeker_detail_id = 0)
    {
        $ids = [];

        if (!empty($items['skill_id'])) {
            $items = $this->prepareInput($items, $user_id, $seeker_detail_id);
            // dd($items);
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
