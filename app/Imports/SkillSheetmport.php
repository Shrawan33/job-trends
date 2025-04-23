<?php

namespace App\Imports;

use App\Models\Skill;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Illuminate\Support\Facades\Response;
use InfyOm\Generator\Utils\ResponseUtil;

class SkillSheetmport implements ToCollection, WithStartRow, WithCalculatedFormulas, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as  $row) {
            if ($row['skill_name_in_english'] != "") {
                $skill = Skill::where('reference_import_id', $row['id'])->first();
                if (isset($skill) && $skill->count() > 0) {
                    $skill->update([
                        'title' => $row['skill_name_in_english'],
                    ]);
                } else {
                    Skill::create([
                    'title' => $row['skill_name_in_english'],
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
