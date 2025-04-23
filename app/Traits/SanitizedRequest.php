<?php
namespace App\Traits;

use App\Models\AbuseWord;

trait SanitizedRequest
{
    private $clean = false;

    public function all($key = null)
    {
        return $this->sanitize(parent::all());
    }

    protected function sanitize(array $inputs)
    {
        if ($this->clean) {
            return $inputs;
        }
        $abuseWords = AbuseWord::get()->pluck('title')->toArray();
        // dd($abuseWords,$inputs['skill_id']);
        foreach (($inputs['skill_id'] ?? [])  as $i => $item) {
            // print_r(in_array($item,$abuseWords));
            $inputs['skill_id'][$i] = in_array($item, $abuseWords) ? null : $item;
        }

        $this->replace($inputs);
        $this->clean = true;
        return $inputs;
    }
}
