<?php

namespace App\Repositories;

use App\Models\AssignEmployer;

/**
 * Class AssignEmployerRepository
 * @package App\Repositories
 */

class AssignEmployerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'employer_id',
        'account_manager_id',
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
        return AssignEmployer::class;
    }

    public function sync(array $items)
    {
        $data = $items;
        // dd($data);
        $id = $data['assign_id'];
        unset($data['assign_id']);
        $search = ['id' => $id];
        if (!empty($items['employer_id'])) {
            return $this->model->updateOrCreate($search, $data);
        }
    }
}
