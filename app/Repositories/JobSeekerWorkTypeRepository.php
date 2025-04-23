<?php

namespace App\Repositories;

use App\Models\JobSeekerWorkType;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobSeekerWorkTypeRepository
 * @package App\Repositories
 * @version January 22, 2021, 11:24 am UTC
*/

class JobSeekerWorkTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'job_seeker_detail_id',
        'work_type_id',
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
        return JobSeekerWorkType::class;
    }

    public function syncByWorkType(array $items = [], Model $seekerDetail)
    {
        return $seekerDetail->workType()->sync($items);
        // $final = [];
        // if (!empty($items)) {
        //     foreach ($items as $key => $itemAr) {
        //         // Update or Create Items
        //         $final['employer_job_id'] = $employerJob_id;
        //         $final['qualification_id'] = $itemAr;

        //         $dataUpdate = $this->model()::where('employer_job_id', $employerJob_id)->where('qualification_id', $itemAr)->first();
        //         if ($dataUpdate) {
        //             $dataUpdate->qualification_id = $itemAr;
        //             $dataUpdate->save();
        //         } else {
        //             $this->model()::insert($final);
        //         }
        //     }
        //     $dataDeletes = $this->model()::where('employer_job_id', $employerJob_id)->get();

        //     foreach ($dataDeletes as $key => $dataDelete) {
        //         if ($dataDelete) {
        //             $quali_arr[] = $dataDelete['qualification_id'];

        //             if (!empty(array_diff($quali_arr, $items))) {
        //                 $quaa = array_diff($quali_arr, $items);
        //                 if (array_key_exists($key, $quaa)) {
        //                     $this->model()::where('employer_job_id', $employerJob_id)->where('qualification_id', $quaa[$key])->delete();
        //                 }
        //             }

        //             continue;
        //         }
        //     }
        // }
    }
}
