<?php

namespace App\Repositories;

use App\Models\EmployerJob;
use Illuminate\Support\Facades\DB;
use MeiliSearch\Endpoints\Indexes;

/**
 * Class EmployerJobRepository
 * @package App\Repositories
 * @version January 22, 2021, 11:24 am UTC
*/

class EmployerJobRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'title',
        'category_id',
        'subcategory_id',
        'description',
        'company_name',
        'company_profile',
        'work_type_id',
        'contact_name',
        'phone_number',
        'website',
        'location',
        'experience_id',
        'salary_id ',
        'interview_type_id',
        'certification_id',
        'job_number',
        'is_featured',
        'salary_type_id',
        'updated_by',
        'created_by',
        'is_deleted',
        'deleted_at',
        'created_at',
        'status',
        'slug',
        'expiration_date',
        'is_urgent',
        'job_type_id',
        'specialization_id',
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
        return EmployerJob::class;
    }

    public function createItem($item)
    {
        $employerInput = [
            'job_number' => $item['job_number'],
            'title' => $item['title'],
            'category_id' => $item['category_id'],
            'description' => $item['description'],
            'work_type_id' => $item['work_type_id'],
            'location_id' => $item['location_id'],
            'experience_id' => $item['experience_id'],
            'salary_type_id' => $item['salary_type_id'],
            'salary_id' => $item['salary_id'],
            'is_featured' => $item['is_featured'],
            'job_type_id' => $item['job_type_id'],
            'specialization_id' => $item['specialization_id'],
            'is_urgent' => $item['is_urgent'],

        ];
        $employerJob = $this->create($employerInput);
        return $employerJob;
    }

    public function updateItem(array $item, $id)
    {
        $employerInput = [
            'job_number' => $item['job_number'],
            'title' => $item['title'],
            'category_id' => $item['category_id'],
            'description' => $item['description'],
            'work_type_id' => $item['work_type_id'],
            'location_id' => $item['location_id'],
            'experience_id' => $item['experience_id'],
            'salary_type_id' => $item['salary_type_id'],
            'salary_id' => $item['salary_id'],
            'is_featured' => $item['is_featured'],
            'job_type_id' => $item['job_type_id'],
            'specialization_id' => $item['specialization_id'],
            'is_urgent' => $item['is_urgent'],
            'approval_status' => $item['approval_status'],


        ];

        $employerJob = $this->update($employerInput, $id, true);
        return $employerJob;
    }

    public function search(array $item, $slug = '')
    {   //dd($item);
        $query = '';
        if ($item['keyword'] ?? null) {
            $query = $item['keyword'];
        }
        $searchString = '';
        if ($item['state_id'] ?? null) {
            $searchString.= "state_id=".$item['state_id'];
        }
        $filterArray = [];

        return $results = EmployerJob::search($query, function(Indexes $meilisearch, $query, $options) use($item, $slug){
            if ($item['job_type_id'] ?? null) {
                $filterArray[] =  "job_type_id=".$item['job_type_id'];
            }

            if ($item['specialization_id'] ?? null) {
                $filterArray[] =  "specialization_id=".$item['specialization_id'];
            }
            if ($item['is_featured'] ?? 0){
                $filterArray[] =  "is_featured=".$item['is_featured'];
            }

            if ($item['is_urgent'] ?? 0){
                $filterArray[] =  "is_urgent=".$item['is_urgent'];
            }

            if ($item['state_id'] ?? null) {
                $filterArray[] =  "state_id=".$item['state_id'];
            }

            $filterArray[] = "approval_status=1";

            if (isset($slug) && $slug != null) {
                $filterArray[] =  "category_slug=".$slug;
            }

            if ($item['location_id'] ?? null) {
                $filterArray[] =  "location_id=".$item['location_id'];
            }

            if ($item['category_id'] ?? null) {
                $categories = [];
                foreach ($item['category_id'] as $key => $value) {
                   $categories[] = 'category_id = '.$value;
                }
                $category_string = implode(' OR ', $categories);
                $filterArray[] =  '('.$category_string.')';
            }

            if ($item['experience_id'] ?? null) {
                $experiences = [];

                foreach ($item['experience_id'] as $key => $value) {
                   $experiences[] = 'experience_id = '.$value;
                }

                $experience_string = implode(' OR ', $experiences);
                $filterArray[] =  '('.$experience_string.')';
            }

            if ($item['work_type_id'] ?? null) {
                $types = implode(',', $item['work_type_id']);
                $job_type_string = "work_type_ids IN [".$types."]";
                $filterArray[] =  '('.$job_type_string.')';
            }

            if ($item['qualification_id'] ?? null) {
                $qualifications = implode(',', $item['qualification_id']);;

                // foreach ($item['qualification_id'] as $key => $value) {
                //    $qualifications[] = 'qualification_id = '.$value;
                // }
                $qualification_string = "qualification_ids IN [".$qualifications."]";
                $filterArray[] =  '('.$qualification_string.')';
            }

            if ($item['skill_id'] ?? null) {
                $skills = implode(',', $item['skill_id']);;

                // foreach ($item['qualification_id'] as $key => $value) {
                //    $qualifications[] = 'qualification_id = '.$value;
                // }
                $skill_string = "skill_ids IN [".$skills."]";
                $filterArray[] =  '('.$skill_string.')';
            }
            // if ($item['specialization_id'] ?? null) {
            //     $specializations = implode(',', $item['specialization_id']);;

            //     // foreach ($item['qualification_id'] as $key => $value) {
            //     //    $qualifications[] = 'qualification_id = '.$value;
            //     // }
            //     $specialization_string = "specialization_ids IN [".$specializations."]";
            //     $filterArray[] =  '('.$specialization_string.')';
            // }
            if ($item['salary_type_id'] ?? null) {
                $salary_types = [];
                foreach ($item['salary_type_id'] as $key => $value) {
                   $salary_types[] = 'salary_type_id = '.$value;
                }
                $salary_type_string = implode(' OR ', $salary_types);
                $filterArray[] =  '('.$salary_type_string.')';
            }

            if ($item['salary_id'] ?? null) {
                $salary = [];
                foreach ($item['salary_id'] as $key => $value) {
                   $salary[] = 'salary_id = '.$value;
                }
                $salary_string = implode(' OR ', $salary);
                $filterArray[] =  '('.$salary_string.')';
            }

            if (!empty($filterArray)) {
                $filter_string = implode(' AND ', $filterArray);
                //dd($filter_string);
                $options['filter'] = $filter_string;
            }

            if ($item['sort_by'] ?? null) {
                if ($item['sort_by'] == 'oldest') {
                    $options['sort'] = ["created_at:asc"];
                } else {
                    $options['sort'] = ["created_at:desc"];
                }
            } else {
                $options['sort'] = ["created_at:desc"];
            }


            $options['attributesToHighlight'] = ["title"];
            //dd($options);
            return $meilisearch->search($query, $options);
        })->paginate(config('constants.pagination.page_no'));


        // $query = $this->allQuery();
        // $query->withQualification()->activeCreatedBy('employer_jobs');
        // $query->withWorkType();
        // $query->withCategory();
        // $query->selectRaw('employer_jobs.*,employer_job_qualifications.qualification_id as qualification_id, categories.slug category_slug,employer_jobs_work_type.work_type_id as job_type_id');
        // if (isset($item['keyword']) && $item['keyword'] != null) {
        //     $query->where(function ($query) use ($item) {
        //         $query->where('employer_jobs.title', 'LIKE', "%{$item['keyword']}%")
        //             ->orWhere('employer_jobs.job_number', 'LIKE', "%{$item['keyword']}%")
        //             ->orWhere('employer_jobs.description', 'LIKE', "%{$item['keyword']}%");
        //     });
        // }
        // if (isset($item['job_type']) && $item['job_type'] != null) {
        //     $query->where('employer_jobs_work_type.work_type_id', $item['job_type']);
        // }

        // if (isset($item['location_id']) && $item['location_id'] != null) {
        //     $query->where('location_id', '=', $item['location_id']);
        // }
        // if (isset($slug) && $slug != null) {
        //     $query->where('categories.slug', '=', $slug);
        // }
        // if (isset($item['category_id']) && !empty($item['category_id'])) {
        //     $query->whereIn('category_id', is_array($item['category_id']) ? $item['category_id'] : [$item['category_id']]);
        // }

        // if (isset($item['qualification_id']) && !empty($item['qualification_id'])) {
        //     $query->whereIn('qualification_id', $item['qualification_id']);
        // }

        // if (isset($item['experience_id']) && !empty($item['experience_id'])) {
        //     $query->whereIn('experience_id', $item['experience_id']);
        // }

        // if (isset($item['salary_type_id']) && !empty($item['salary_type_id'])) {
        //     $query->whereIn('salary_type_id', $item['salary_type_id']);
        // }

        // if (isset($item['salary_id']) && !empty($item['salary_id'])) {
        //     $query->whereIn('salary_id', $item['salary_id']);
        // }

        // $query->groupBy('employer_jobs.id');

        // $query->orderBy('employer_jobs.created_at', 'desc');

        // return $query->paginate(config('constants.pagination.page_no'))->fragment('search');
    }

    public function getRelatedJobs($employerJob)
    {
        $relatedJobs = $employerJob->relatedJobs();
        return $relatedJobs->count() > 0 ? $relatedJobs->get()->where('id', '!=', $employerJob->id) : collect([]);
    }

    public function getJobPosted($filter = [], $return = 'count')
    {
        $search = [
            'deleted_at' => null,
        ];

        $select = DB::raw('count(employer_jobs.id) as count');
        // dashboard filter
        if (!empty($filter)) {
            if (isset($filter['start_date'])) {
                $search['created_at']['conditions'] = [];
                if (isset($filter['start_date'])) {
                    array_push($search['created_at']['conditions'], ['>=' => $filter['start_date']]);
                }
            }
        }

        $data = $this->all($search, null, null, $select, [], [], []);

        if ($return == 'count') {
            $count = $data->count() > 0 ? $data->first()->count : 0;
            return $count;
        }

        return $data->all();
    }
}
