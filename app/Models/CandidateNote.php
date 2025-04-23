<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use App\Traits\ToSqlDate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CandidateNote
 * @package App\Models
 * @version November 11, 2022, 6:03 am UTC
 *
 * @property unsignedInteger $candidate_id
 * @property string $note
 */
class CandidateNote extends Model
{
    use ToSqlDate;
    use ModelState;
    public $table = 'candidate_notes';






    public $fillable = [
        'candidate_id',
        'note',
        'employer_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'note' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'candidate_id' => 'required',
        'note' => 'required'
    ];

    /**
     * Get the user that owns the CandidateNote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function candidate(): BelongsTo
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
