<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Throwable;

/**
 * @SWG\Definition(
 *      definition="Configuration",
 *      required={"setting_type", "setting_field", "setting_value"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="setting_type",
 *          description="setting_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="setting_field",
 *          description="setting_field",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="setting_value",
 *          description="setting_value",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Configuration extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'configurations';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'setting_type',
        'setting_sub_type',
        'setting_field',
        'setting_value',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'setting_type' => 'string',
        'setting_sub_type' => 'string',
        'setting_field' => 'string',
        'setting_value' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'setting_type' => 'required',
        'setting_field' => 'required|unique:configurations,setting_type,setting_field',
        // 'setting_value' => 'required'
    ];

    public function scopePatternOfModule($query, $field)
    {
        return $query->whereSettingField($field);
    }

    /**
     * setSessionConfiguration function
     *
     * @return object
     */
    public static function setSessionConfiguration() : Collection
    {
        $types = config('constants.sessionConfigurationParams', []);
        $configurations = self::whereIn('setting_type', $types)->get();
        Session::put('configuration', $configurations);
        return $configurations;
    }

    /**
     * getSessionConfiguration function
     *
     * @param array $types
     * @param string $sub_type
     * @return collection
     */
    public static function getSessionConfiguration(array $types, string $sub_type = null) : collection
    {
        // $configurations = Session::get('configuration', null);
        $data = Collection::make([]);
        try {
            // if (empty($configurations)) {
            $configurations = self::setSessionConfiguration();
            // }

            if ($configurations->count() > 0) {
                $data = $configurations->whereIn('setting_type', $types);

                if (!empty($sub_type)) {
                    $data = $data->where('setting_sub_type', $sub_type);
                }
            }
        } catch (Throwable $th) {
            //throw $th;
            $data = Collection::make([]);
        }

        return $data;
    }

    /**
     * getSessionConfigurationName function
     *
     * @param array $types
     * @param string $sub_type
     * @param string $name
     * @return string
     */
    public static function getSessionConfigurationName(array $types, string $sub_type = null, string $name = null)
    {
        // $configurations = Session::get('configuration', null);

        $data = null;

        try {
            // if (empty($configurations)) {
                $configurations = self::setSessionConfiguration();
            // }

            if (!empty($configurations) && $configurations->count() > 0) {
                $configuration = $configurations->whereIn('setting_type', $types);

                if (!empty($sub_type)) {
                    $configuration = $configuration->where('setting_sub_type', $sub_type);
                }

                if (!empty($name)) {
                    $data = $configuration->where('setting_field', $name)->first()->setting_value;
                }
            }
        } catch (Throwable $th) {
            //throw $th;
        }
        return $data;
    }
}
