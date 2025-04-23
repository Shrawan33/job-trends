<?php

namespace App\Repositories;

use App\Models\JobSeekerLanguage;

/**
 * Class UserRepository
 * @package App\Repositories
 */

class jobSeekerLanguageSkillRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'language_id',
        'speak_id',
        'read_write_id',
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
        return JobSeekerLanguage::class;
    }

    public function prepareInput($items = [], $user_id = 0)
    {
        $result = [];
        foreach ($items['language_id'] as $key => $value) {
            if ($value != '') {
                $result[] = [
                    'id' => $items['lan_id'][$key] ?? 0,
                    'user_id' => $user_id ?? null,
                    'language_id' => $items['language_id'][$key] ?? null,
                    'speak_id' => $items['speak_id'][$key] ?? null,
                    'read_write_id' => $items['read_write_id'][$key] ?? null,

                ];
            }
        }
        return $result;
    }

    public function synclanguageSkill(array $items, $user_id)
    {
        $ids = [];
        if (!empty($items['language_id'])) {
            $items = $this->prepareInput($items, $user_id);
            foreach ($items as $itemAr) {
                // Update or Create Items
                $item = $this->updateOrCreate($itemAr);
                array_push($ids, $item->id);
            }
        }
        // Remove Items
        $this->deleteByType($ids, $user_id, 'user_id');
    }
}
