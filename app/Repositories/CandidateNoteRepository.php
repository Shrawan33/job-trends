<?php

namespace App\Repositories;

use App\Models\CandidateNote;
use App\Repositories\BaseRepository;

/**
 * Class CandidateNoteRepository
 * @package App\Repositories
 * @version November 11, 2022, 6:03 am UTC
*/

class CandidateNoteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'candidate_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CandidateNote::class;
    }
}
