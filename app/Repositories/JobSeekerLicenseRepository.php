<?php

namespace App\Repositories;

use App\Models\JobSeekerLicense;

/**
 * Class UserRepository
 * @package App\Repositories
 */

class JobSeekerLicenseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'certificate_name',
        'certifying_authority',
        'from_month',
        'from_year',
        'to_month',
        'to_year',
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
        return JobSeekerLicense::class;
    }

    public function prepareInput($items = [], $user_id = 0, $seeker_detail_id = 0)
    {
        $result = [];
        foreach ($items['certificate_name'] as $key => $value) {
            if ($value != '') {
                $result[] = [
                    'id' => $items['lic_id'][$key] ?? 0,
                    'user_id' => $user_id ?? null,

                    'certificate_name' => $items['certificate_name'][$key] ?? null,
                    'certifying_authority' => $items['certifying_authority'][$key] ?? null,
                    'from_month' => $items['from_month'][$key] ?? null,
                    'from_year' => $items['from_year'][$key] ?? null,
                    'seeker_detail_id' => $seeker_detail_id
                ];
                // dd($result);
            }
        }
        return $result;
    }

    public function syncLicense(array $items, $user_id, $seeker_detail_id = 0)
    {
        $ids = [];
        // dd($items);
        if (!empty($items['certificate_name'])) {
            $items = $this->prepareInput($items, $user_id, $seeker_detail_id);
            foreach ($items as $itemAr) {
                // Update or Create Items
                $item = $this->updateOrCreate($itemAr);
                array_push($ids, $item->id);
            }
        }
        // Remove Items
        // dd($seeker_detail_id);
        $this->deleteByType($ids, $user_id, 'user_id', $seeker_detail_id);
    }

    public function deleteByType($ids, $source_id, $type = 'user_id', $seeker_detail_id = 0)
    {
        // dd($seeker_detail_id);
        $query = $this->model->where($type, $source_id);
        if (!empty($ids)) {
            $query->whereNotIn('id', $ids);
        }
        $query->where('seeker_detail_id', $seeker_detail_id);
        $query->delete();
    }
}
