<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ZoomMeeting
 * @package App\Models
 * @version January 18, 2021, 10:08 am UTC
 *
 * @property string $title
 */
class ZoomMeeting extends Model
{
    use CreatedByUpdatedBy;
    use ModelState;
    use ToSqlDate;
    use SoftDeletes;

    public $table = 'zoom_meeting';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'topic',
        'start_time',
        'duration',
        'agenda',
        'host_video',
        'participant_video',
        'created_by',
        'updated_by',
        'is_deleted',
        'jobseeker_id',
        'employer_job_id',
        'start_url',
        'join_url',
        'password',
        'host_id',
        'main_id',
        'meeting_json'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'topic' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
}
