<?php

namespace App\Repositories;

use App\Models\Remark;

/**
 * Class UserRepository
 * @package App\Repositories
 */

class RemarkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'shortlisted_id',
        'content',
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
        return Remark::class;
    }

    public function prepareInput($items = [], $shortlisted_id = 0)
    {
        $result = [];
        foreach ($items['remark_id'] as $key => $value) {
            if ($items['remark'][$key] != '') {
                $result[] = [
                    'id' => $value ?? 0,
                    'shortlisted_id' => $shortlisted_id ?? null,
                    'content' => $items['remark'][$key] ?? '',
                ];
            }
        }
        return $result;
    }

    public function syncRemark(array $items, $shortlisted_id)
    {
        $ids = [];

        if (!empty($items['remark_id'])) {
            $items = $this->prepareInput($items, $shortlisted_id);

            foreach ($items as $itemAr) {
                // Update or Create Items
                $item = $this->updateOrCreate($itemAr);
                array_push($ids, $item->id);
            }
        }
        // Remove Items
        $this->deleteByType($ids, $shortlisted_id, 'shortlisted_id');
    }
}
