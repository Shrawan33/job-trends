<?php

namespace App\Repositories;

use App\Helpers\FunctionHelper;
use App\Models\ApplyJob;
use Illuminate\Support\Facades\DB;

/**
 * Class ApplyJobRepository
 * @package App\Repositories
 * @version January 12, 2021, 7:09 am UTC
*/

class ApplyJobRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'employer_job_id',
        'is_apply',
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
        return ApplyJob::class;
    }

    public function getApplyJobs($filter = [], $return = 'count')
    {
        // status = ""

        $search = [
            'deleted_at' => null,
            // 'created_at' => ['conditions' => [['>' => FunctionHelper::today(false, true)]]],
            'user_id' => ['conditions' => [['!=' => null]]],
        ];

        $select = DB::raw('count(applied_jobs.id) as count');
        // dashboard filter
        if (!empty($filter)) {
            if (isset($filter['start_date'])) {
                $search['created_at']['conditions'] = [];
                if (isset($filter['start_date'])) {
                    array_push($search['created_at']['conditions'], ['>=' => $filter['start_date']]);
                }
            }
        }

        $data = $this->all($search, null, null, $select, [], [], []);

        if ($return == 'count') {
            $count = $data->count() > 0 ? $data->first()->count : 0;
            return $count;
        }

        return $data->all();
    }

    public function status_count()
    {
        $currentDate = date('Y-m-d');
        //DB::enableQueryLog();
        $query = $this->allQuery();
        //$query->select('*');
        $query->selectRaw('applied_jobs.status, count(applied_jobs.id) as total');
        $query->join('employer_jobs', 'employer_jobs.id', '=', 'applied_jobs.employer_job_id');
        $query->join('users', 'users.id', '=', 'employer_jobs.created_by');
        $query->where('applied_jobs.user_id', \Auth::user()->id);
        $query->where('employer_jobs.expiration_date', '>=', $currentDate);
        $query->groupBy('applied_jobs.status');

        //dd($query->get(),DB::getQueryLog());
        return $query->get();
    }

    public function status_count_employer()
    {
        $query = $this->allQuery();
        $query->selectRaw('applied_jobs.status, count(applied_jobs.id) as total');
        $query->join('employer_jobs', 'employer_jobs.id', '=', 'applied_jobs.employer_job_id');
        $query->where('employer_jobs.created_by', \Auth::user()->id);
        $query->groupBy('applied_jobs.status');
        return $query->get();
    }
}
