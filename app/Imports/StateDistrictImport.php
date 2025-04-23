<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StateDistrictImport implements WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function sheets(): array
    {
      return  [
            'State' => new StateSheetmport(),
            'District' => new DistrictSheetImport(),
        ];



    }
}
