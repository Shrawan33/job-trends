<?php

namespace App\Imports;

use App\Models\State;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Illuminate\Support\Facades\Response;
use InfyOm\Generator\Utils\ResponseUtil;

class StateSheetmport implements ToCollection, WithStartRow, WithCalculatedFormulas, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as  $row) {
            if ($row['state_name_in_english'] != "") {
                $state = State::where('title', $row['state_name_in_english'])->first();
                if (isset($state) && $state->count() > 0) {
                    $state->update([
                        'title' => $row['state_name_in_english'],
                    ]);
                } else {
                    State::create([
                    'title' => $row['state_name_in_english'],
                    'refrence_import_id' => $row['id'],
                    'country_id' => 356
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
