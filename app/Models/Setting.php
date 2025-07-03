<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Setting
 * @package App\Models
 * @version January 20, 2023, 6:48 am UTC
 *
 * @property string $title
 */
class Setting extends Model
{

    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = ['page', 'key', 'value'];

    protected $casts = ['value' => 'string'];

    public function getDecodedValueAttribute()
    {
        return json_decode($this->value, true);
    }


    public static function getJsonValue(string $key, $default = [])
    {
        $setting = static::where('key', $key)->first();
        return $setting ? json_decode($setting->value, true) ?? $default : $default;
    }

    public static function set(string $key, $value, $page = null): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => is_array($value) ? json_encode($value) : $value,
                'page' => $page,
            ]
        );
    }
}