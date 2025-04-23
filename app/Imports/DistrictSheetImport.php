<?php

namespace App\Imports;

use App\Models\Location;
use App\Models\State;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class DistrictSheetImport implements ToCollection, WithStartRow, WithCalculatedFormulas, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $state = "";



        foreach ($rows as $row) {
             //state
            if($row['state'] != ""){
                $state = State::where('title',$row['state'])->first();
                if(!empty($state->id))
                $state_id = $state->id;
            }


            if($row['district_name_in_english'] != ""){
                $location = Location::where('title',$row['district_name_in_english'])->first();
                if(isset($location) && $location->count() > 0){
                    $location->update([
                        'title' => $row['district_name_in_english'],
                    ]);
                }
                else{
                    $location =  Location::create([
                        'title' => $row['district_name_in_english'],
                        'state_id' => $state_id,
                        'refrence_import_id' => $row['id']
                    ]);

                }
            }

        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
