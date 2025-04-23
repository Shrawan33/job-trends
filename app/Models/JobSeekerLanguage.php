<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSeekerLanguage extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'job_seeker_languages';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'language_id',
        'speak_id',
        'read_write_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'language_id' => 'integer',
        'speak_id' => 'integer',
        'read_write_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',

    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function speak()
    {
        return $this->belongsTo(Level::class, 'speak_id', 'id');
    }

    public function read_write()
    {
        return $this->belongsTo(Level::class, 'read_write_id', 'id');
    }

    public function getEducationAttribute()
    {
        $education = [
            'qualification' => $this->qualification->title,
            'university' => $this->university ?? null,
            'location' => $this->location ?? null,
            'duration' => $this->duration_from . ' - ' . $this->duration_to ?? null
        ];
        return implode(', ', array_filter($education));
    }
}
