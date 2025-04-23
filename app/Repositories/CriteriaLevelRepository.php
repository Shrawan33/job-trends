<?php

namespace App\Repositories;

use App\Models\CriteriaLevel;

/**
 * Class CriteriaLevelRepository
 * @package App\Repositories
 * @version May 27, 2021, 5:46 am UTC
*/

class CriteriaLevelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'criteria_id',
        'level',
        'score'
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
        return CriteriaLevel::class;
    }

    public function prepareInput($items = [], $criteria_id = 0)
    {
        $result = [];
        foreach ($items['level'] as $key => $value) {
            if ($value != '') {
                $result[] = [
                    'id' => $value['level_id'] ?? 0,
                    'criteria_id' => $criteria_id ?? null,
                    'level' => $key ?? null,
                    'score' => $value['score'] ?? null,
                ];
            }
        }
        return $result;
    }

    public function syncLevel(array $items, $criteria_id)
    {
        $ids = [];
        if (!empty($items['level'])) {
            $items = $this->prepareInput($items, $criteria_id);
            foreach ($items as $itemAr) {
                // Update or Create Items
                $item = $this->updateOrCreate($itemAr);
                array_push($ids, $item->id);
            }
        }
        // Remove Items
        $this->deleteByType($ids, $criteria_id, 'criteria_id');
    }
}
