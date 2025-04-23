<?php

namespace App\Imports;

use App\Models\Certification;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCertification implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Certification([
            //
        ]);
    }
}
