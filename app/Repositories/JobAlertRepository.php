<?php

namespace App\Repositories;

use App\Models\JobAlert;
use Illuminate\Support\Facades\DB;

/**
 * Class JobAlertRepository
 * @package App\Repositories
 * @version February 9, 2021, 3:20 pm UTC
*/

class JobAlertRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'search_term',
        'location_id',
        'created_at',
        'updated_at',
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
        return JobAlert::class;
    }

    public function getJobAlerts($filter = [], $return = 'count')
    {
        $search = [
            'deleted_at' => null,
        ];

        $select = DB::raw('count(job_alerts.id) as count');
        // dashboard filter
        if (!empty($filter)) {
            if (isset($filter['start_date']) || isset($filter['end_date'])) {
                if (isset($filter['start_date'])) {
                    $search['created_at']['conditions'] = [];
                    if (isset($filter['start_date'])) {
                        array_push($search['created_at']['conditions'], ['>=' => $filter['start_date']]);
                    }
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
}
