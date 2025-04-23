<?php

namespace App\Repositories;

use App\Models\Package;

/**
 * Class PackageRepository
 * @package App\Repositories
 * @version March 31, 2021, 8:32 am UTC
*/

class PackageRepository extends BaseRepository
{
    // protected $packageModel;

    // public function __construct(Package $package)
    // {
    //     $this->packageModel = $package;
    // }
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'role_type',
        'package_type',
        'title',
        'credit_info',
        'is_default',
        'package_category_id',
        'is_addon',
        'addon_list'
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
        return Package::class;
    }
    public function getEmployerPackages()
    {
        return $this->model->where('role_type', 'employers')->get();
    }
    public function prepareToJson($input = [])
    {
        $input['credit_info'] = ['credits' => $input['credits'] ?? [], 'deduction' => $input['deduction'] ?? []];
        return $input;
    }

}
