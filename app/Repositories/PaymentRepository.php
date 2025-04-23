<?php

namespace App\Repositories;

use App\Models\Payment;

/**
 * Class PaymentRepository
 * @package App\Repositories
 * @version April 29, 2021, 1:35 pm UTC
*/

class PaymentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'session_id',
        'package_id',
        'amount',
        'entity_type',
        'token',
        'transaction_status',
        'transaction_response'
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
        return Payment::class;
    }
}
