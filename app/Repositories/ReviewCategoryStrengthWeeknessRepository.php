<?php

namespace App\Repositories;

use App\Models\ReviewCategoryStrengthWeekness;
use App\Repositories\BaseRepository;

/**
 * Class ReviewCategoryStrengthWeeknessRepository
 * @package App\Repositories
 * @version June 23, 2023, 5:45 am UTC
*/

class ReviewCategoryStrengthWeeknessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'review_category_id',
        'review_category_type',
        'title'
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
        return ReviewCategoryStrengthWeekness::class;
    }
}
