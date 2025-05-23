<?php

namespace App\Repositories;

use App\Models\FavoriteCandidate;

/**
 * Class FavoriteCandidateRepository
 * @package App\Repositories
 * @version January 12, 2021, 7:09 am UTC
*/

class FavoriteCandidateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'status',
        'suggested_title'
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
        return FavoriteCandidate::class;
    }
}
