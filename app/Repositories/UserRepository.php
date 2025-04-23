<?php

namespace App\Repositories;

use App\Helpers\FunctionHelper;
use App\Models\Experience;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository
 * @package App\Repositories
 */

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'email',
        'first_name',
        'last_name',
        'company_name',
        'phone_number',
        'hide_profile',
        'role_id',
        'created_at'
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
        return User::class;
    }

    public function makeUserContactVerified(int $userId, string $verification)
    {
        $updateData = [];

        switch ($verification) {
            case 'email':
                $updateData['email_verified_at'] = date('Y-m-d H:i:s');
                break;

            case 'phone':
                $updateData['mobile_verified_at'] = date('Y-m-d H:i:s');
                break;
        }

        return $this->model()::whereId($userId)->update($updateData);
    }

    public function search(array $item)
    {
        // dd($item);
        $query = $this->allQuery();
        $query->WithSeekerFilter();
        $query->WithRole();
        $query->with('favourite','seekerDetail.location','seekerDetail.state','image');
        $query->selectRaw('users.id,users.first_name,users.last_name,users.created_at,users.email,slug,job_seeker_detail.title as job_title, job_seeker_detail.total_experience, job_seeker_skill.id as skill_id, job_seeker_education.qualification_id as qualification_id, job_seeker_experience.id as experience_id,model_has_roles.role_id,job_seeker_work_type.work_type_id');
        if (isset($item['keyword']) && $item['keyword'] != null) {
            $query->where(function ($query) use ($item) {
                $query->where('job_seeker_detail.title', 'LIKE', "%{$item['keyword']}%")
                    ->orWhere('job_seeker_detail.description', 'LIKE', "%{$item['keyword']}%")
                    ->orWhere('users.first_name', 'LIKE', "%{$item['keyword']}%")
                    ->orWhere('users.last_name', 'LIKE', "%{$item['keyword']}%");
            });
        }
        if (isset($item['specialization_id']) && $item['specialization_id'] != null) {
            $query->where('job_seeker_detail.specialization_id', '=', $item['specialization_id']);
        }
        if (isset($item['state_id']) && $item['state_id'] != null) {
            $query->where('job_seeker_detail.state_id', '=', $item['state_id']);
        }

        if (isset($item['job_type_id']) && $item['job_type_id'] != null) {
            $query->whereIn('job_seeker_work_type.work_type_id', $item['job_type_id']);
        }

        if (isset($item['location_id']) && $item['location_id'] != null) {
            $query->where('job_seeker_detail.location_id', '=', $item['location_id']);
        }

        if (isset($item['salary_id']) && !empty($item['salary_id'])) {
            $salaries = $this->getSalary($item['salary_id']);
            $query->where(function ($query) use ($salaries) {
                foreach ($salaries as $salary) {
                    $query->orWhere(function ($q) use ($salary) {
                        if (!empty($salary->start)) {
                            $q->Where('job_seeker_detail.salary', '>=', $salary->start);
                        }
                        if (!empty($salary->end)) {
                            $q->where('job_seeker_detail.salary', '<=', $salary->end);
                        }
                    });
                }
            });
        }
        if (isset($item['salary_type_id']) && !empty($item['salary_type_id'])) {
            $query->whereIn('job_seeker_detail.salary_type_id', $item['salary_type_id']);
        }
        if (isset($item['skill_id']) && !empty($item['skill_id'])) {
            $query->whereIn('skill_id', $item['skill_id']);
        }

        if (isset($item['qualification_id']) && !empty($item['qualification_id'])) {
            $query->whereIn('qualification_id', $item['qualification_id']);
        }

        if (isset($item['experience_id']) && !empty($item['experience_id'])) {
            $experiences = $this->getExperince($item['experience_id']);
            $query->where(function ($query) use ($experiences) {
                foreach ($experiences as $experience) {
                    $query->orWhere(function ($q) use ($experience) {
                        if (!empty($experience->from)) {
                            $q->Where('job_seeker_detail.total_experience', '>=', $experience->from);
                        }
                        if (!empty($experience->to)) {
                            $q->where('job_seeker_detail.total_experience', '<=', $experience->to);
                        }
                    });
                }
            });
        }

        $query->where('model_has_roles.role_id', '=', 3); // employer
        $query->where('users.hide_profile', false);
        $query->groupBy('users.id');

        // dd($query->toSql());
        return $query->paginate(config('constants.pagination.page_no'))->fragment('search');
    }

    public function getExperince($id)
    {
        return Experience::whereIn('id', $id)->get();
    }

    public function getSalary($id)
    {
        return Salary::whereIn('id', $id)->get();
    }

    public function createInputDataForPdf($jobseekerId)
    {
        $input = [];

        //get created by user info

        $jobseeker = $this->find($jobseekerId, ['*'], true);

        if (!empty($jobseeker)) {
            $input = $this->model->prepareInput($jobseeker);
        }

        return $input;
    }



    public function getCvPdf($jobseekerId, $name = '')
    {
        $input = $this->createInputDataForPdf($jobseekerId);

        $input->file_name = $input->full_name;
        // dd(str_replace(' ', 'no-data', $input->file_name) . '-CV.pdf');
        $name = ($input->file_name == ' ') ? str_replace(' ', 'no-data', $input->file_name) . '-CV.pdf' : $input->file_name . '-CV.pdf';
        // dd($input);
        return FunctionHelper::preparePdf($input, 'users.make_a_cv_profile_pdf', true, true, $name);
    }





    public function getUsers($filter = [], $return = 'count')
    {
        $search = ['deleted_at' => null];

        $select = DB::raw('count(users.id) as count');
        // dashboard filter
        if (!empty($filter)) {
            if (isset($filter['role'])) {
                $role = $filter['role'] == 'employer' ? 2 : 3;
                if (isset($filter['role'])) {
                    $search = [
                        'deleted_at' => null,
                        'role_id' => $role,
                    ];
                }
            }

            if (isset($filter['start_date'])) {
                $search['created_at']['conditions'] = [];
                if (isset($filter['start_date'])) {
                    array_push($search['created_at']['conditions'], ['>=' => $filter['start_date']]);
                }
            }
        }

        $data = $this->all($search, null, null, $select, [], [], [], null, [], [], 'withRole');

        if ($return == 'count') {
            $count = $data->count() > 0 ? $data->first()->count : 0;
            return $count;
        }

        return $data->all();
    }

    public function getFeaturedUsers($type)
    {
        $query = $this->allQuery();
        if ($type == 2) {
            $query->with('usersProfile');
        } else {
            $query->with('seekerDetail');
        }

        $query->WithRole();

        $query->where('model_has_roles.role_id', '=', $type)->where('featured', 1);
        $query->groupBy('users.id');

        $sortby = 'users.created_at DESC';
        $query->orderByRaw($sortby);
        if ($type == 2) {
            $query->limit('8');
        } else {
            $query->limit('4');
        }

        return $query->get();
    }

    public function basicReviews() {
        $query = User::with(['review' => function ($query) {
            $query->where('review_type', 1);
            $query->where('approval_status', 1);
            $query->orderBy('created_at', 'DESC');
        },
        'userBadge' => function ($query) {
            $query->select('*', DB::raw('COUNT(*) as user_badge_count'));
            $query->groupBy('badge_id');
        },
        'userBadge.badge'])
        ->whereHas('review', function ($query) {
            $query->where('review_type', 1);
            $query->where('approval_status', 1);
            $query->orderBy('created_at', 'DESC');
        });

        $query->WithRole();

        $query->groupBy('users.id')
      ->join('user_reviews', 'users.id', '=', 'user_reviews.review_to_id')
      ->where('user_reviews.review_type', 1)
      ->where('user_reviews.approval_status', 1)
      ->orderBy('user_reviews.created_at', 'DESC')
      ->select('users.*'); // Make sure to select only users' columns to avoid ambiguous column issues
        // $query->limit('10');
        $paginatedData = $query->paginate(10);
        $data = $paginatedData->map(function ($data) {
            $userBadges = [];
            $userBadge = $data->userBadge->groupBy('badge_id');

            foreach ($userBadge as $id => $badge_review) {
                $review = $badge_review->first();
                $userBadges[$id]['badge_count'] =  $review->user_badge_count;
                $userBadges[$id]['badge_model'] =  $review->badge;
            }
            $data->badge_data =  $userBadges;
            return $data;
        });
        //dd($data);
       return $paginatedData;
    }
}
