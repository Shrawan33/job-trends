<?php

namespace App\Repositories;

use App\Models\Testimonial;
use App\Repositories\BaseRepository;

/**
 * Class TestimonialRepository
 * @package App\Repositories
 * @version March 15, 2021, 5:58 pm UTC
*/

class TestimonialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'client',
        'location'
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
        return Testimonial::class;
    }
}
