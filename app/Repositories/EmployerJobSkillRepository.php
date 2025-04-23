<?php

namespace App\Repositories;

use App\Models\EmployerJob;
use App\Models\EmployerJobSkill;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Model;
use Throwable;

/**
 * Class EmployerJobSkillRepository
 * @package App\Repositories
 * @version January 22, 2021, 11:24 am UTC
*/

class EmployerJobSkillRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'employer_job_id',
        'skill_id',
        'updated_by',
        'created_by',
        'is_deleted',
        'deleted_at'
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
        return EmployerJobSkill::class;
    }

    // public function syncBySkill(array $items = [], Model $employerJob)
    // {
    //     return $employerJob->skill()->sync($items);
    //     // $final = [];
    //     // if (!empty($items)) {
    //     //     foreach ($items as $key => $itemAr) {
    //     //         // Update or Create Items
    //     //         $final['employer_job_id'] = $employerJob_id;
    //     //         $final['skill_id'] = $itemAr;

    //     //         $dataUpdate = $this->model()::where('employer_job_id', $employerJob_id)->where('skill_id', $itemAr)->first();
    //     //         if ($dataUpdate) {
    //     //             $dataUpdate->skill_id = $itemAr;
    //     //             $dataUpdate->save();
    //     //         } else {
    //     //             $this->model()::insert($final);
    //     //         }
    //     //     }
    //     //     $dataDeletes = $this->model()::where('employer_job_id', $employerJob_id)->get();

    //     //     foreach ($dataDeletes as $key => $dataDelete) {
    //     //         if ($dataDelete) {
    //     //             $skill_arr[] = $dataDelete['skill_id'];

    //     //             if (!empty(array_diff($skill_arr, $items))) {
    //     //                 $ba = array_diff($skill_arr, $items);
    //     //                 if (array_key_exists($key, $ba)) {
    //     //                     $this->model()::where('employer_job_id', $employerJob_id)->where('skill_id', $ba[$key])->delete();
    //     //                 }
    //     //             }

    //     //             continue;
    //     //         }
    //     //     }
    //     // }
    // }

    public function prepareInput($items = [], $employer_job_id = 0)
    {
        $result = [];
        foreach ($items as $key => $value) {
            if ($value != '') {
                if (is_numeric($value) === false) {
                    try {
                        // add new skill
                        $value = Skill::firstOrCreate(['title' => $value])->id;
                    } catch (Throwable $e) {
                        continue;
                    }
                }

                $result[] = [
                    'employer_job_id' => $employer_job_id ?? null,
                    'skill_id' => $value ?? null,
                ];
            }
        }
        // dd($items, $employer_job_id, $result);
        return $result;
    }

    public function syncBySkill(array $items, EmployerJob $employerJob)
    {
        $ids = [];
        $employer_job_id = $employerJob->id ?? 0;
        // dd($items);
        if (!empty($items)) {
            $items = $this->prepareInput($items, $employer_job_id);
            // dd($items);
            foreach ($items as $itemAr) {
                // Update or Create Items
                $item = $this->updateOrCreate($itemAr);
                array_push($ids, $item->id);
            }
        }
        // Remove Items
        $this->deleteByType($ids, $employer_job_id, 'employer_job_id');
    }

    public function updateOrCreate($data)
    {
        // $id = $data['id'];
        // unset($data['id']);
        // $search = ['id' => $id];
        return $this->model->updateOrCreate($data);
    }
}
