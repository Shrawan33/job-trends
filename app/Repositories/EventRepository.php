<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\BaseRepository;

/**
 * Class EventRepository
 * @package App\Repositories
 * @version November 30, 2023, 9:08 am UTC
*/

class EventRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'event_title',
        'event_description',
        'event_date'
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
        return Event::class;
    }
}
