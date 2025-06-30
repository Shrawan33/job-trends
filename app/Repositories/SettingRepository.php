<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\BaseRepository;
/**
 * Class SettingRepository
 * @package App\Repositories
 * @version January 20, 2023, 6:48 am UTC
*/

class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'
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
        return Setting::class;
    }
}
