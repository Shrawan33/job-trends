<?php

namespace App\Repositories;

use App\Models\ScoreBoard;

/**
 * Class ScoreBoardRepository
 * @package App\Repositories
 */

class ScoreBoardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'user_id',
        'criteria',
        'score',
        'created_at'
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
        return ScoreBoard::class;
    }

    public function prepareInput($items = [], $user_id = 0)
    {

        $result = [];
        foreach ($items['score'] as $key => $value) {
            if ($value != '') {
                $result[] = [
                    'id' => $value['id'] ?? 0,
                    'user_id' => $user_id ?? null,
                    'score' => $value['level'] ?? null,
                    'criteria' => $key
                ];
            }
        }
        // dd($result);
        return $result;
    }

    public function synScore(array $items, $user_id)
    {
        $ids = [];
        if (!empty($items['score'])) {
            $items = $this->prepareInput($items, $user_id);
            // dd($items);
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
