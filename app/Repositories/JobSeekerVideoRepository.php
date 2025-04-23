<?php

namespace App\Repositories;

use App\Models\JobSeekerVideo;

/**
 * Class UserRepository
 * @package App\Repositories
 */

class JobSeekerVideoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'video_url',
        'video_title',
        'video_description'
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
        return JobSeekerVideo::class;
    }
}
