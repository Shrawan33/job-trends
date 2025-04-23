<?php

namespace App\Repositories;

use App\Models\EmployerJob;
use App\Models\EmployerJobQualification;
use App\Models\Qualification;
use Illuminate\Database\Eloquent\Model;
use Throwable;

/**
 * Class EmployerJobQualificationRepository
 * @package App\Repositories
 * @version January 22, 2021, 11:24 am UTC
*/

class EmployerJobQualificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'employer_job_id',
        'qualification_id',
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
        return EmployerJobQualification::class;
    }

    // public function syncByQualification(array $items = [], Model $employerJob)
    // {
    //     return $employerJob->qualification()->sync($items);
    //     // $final = [];
    //     // if (!empty($items)) {
    //     //     foreach ($items as $key => $itemAr) {
    //     //         // Update or Create Items
    //     //         $final['employer_job_id'] = $employerJob_id;
    //     //         $final['qualification_id'] = $itemAr;

    //     //         $dataUpdate = $this->model()::where('employer_job_id', $employerJob_id)->where('qualification_id', $itemAr)->first();
    //     //         if ($dataUpdate) {
    //     //             $dataUpdate->qualification_id = $itemAr;
    //     //             $dataUpdate->save();
    //     //         } else {
    //     //             $this->model()::insert($final);
    //     //         }
    //     //     }
    //     //     $dataDeletes = $this->model()::where('employer_job_id', $employerJob_id)->get();

    //     //     foreach ($dataDeletes as $key => $dataDelete) {
    //     //         if ($dataDelete) {
    //     //             $quali_arr[] = $dataDelete['qualification_id'];

    //     //             if (!empty(array_diff($quali_arr, $items))) {
    //     //                 $quaa = array_diff($quali_arr, $items);
    //     //                 if (array_key_exists($key, $quaa)) {
    //     //                     $this->model()::where('employer_job_id', $employerJob_id)->where('qualification_id', $quaa[$key])->delete();
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
                        $value = Qualification::firstOrCreate(['title' => $value])->id;
                    } catch (Throwable $e) {
                        continue;
                    }
                }

                $result[] = [
                    'employer_job_id' => $employer_job_id ?? null,
                    'qualification_id' => $value ?? null,
                ];
            }
        }
        // dd($items, $employer_job_id, $result);
        return $result;
    }

    public function syncByQualification(array $items, EmployerJob $employerJob)
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
