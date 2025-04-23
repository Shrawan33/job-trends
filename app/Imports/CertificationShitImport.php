<?php

namespace App\Imports;

use App\Models\Certification;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CertificationShitImport implements ToCollection,WithStartRow,WithCalculatedFormulas,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as  $row) {
            if ($row['certification_name_in_english'] != "") {
                $skill = Certification::where('reference_import_id', $row['id'])->first();
                if (isset($skill) && $skill->count() > 0) {
                    $skill->update([
                        'title' => $row['certification_name_in_english'],
                    ]);
                } else {
                    Certification::create([
                    'title' => $row['certification_name_in_english'],
                    'reference_import_id' => $row['id']
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
