<?php

namespace App\Repositories;

use App\Models\DBNotification;

/**
 * Class MessageRepository
 * @package App\Repositories
 * @version March 24, 2021, 6:12 am UTC
*/

class MessageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'sender_id',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at'
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
        return DBNotification::class;
    }
}
