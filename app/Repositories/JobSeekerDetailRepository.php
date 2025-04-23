<?php

namespace App\Repositories;

use App\Helpers\FunctionHelper;
use App\Models\JobAlert;
use App\Models\JobSeekerDetail;
use Parsedown;

/**
 * Class UserRepository
 * @package App\Repositories
 */

class JobSeekerDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'location',
        'phone_number',
        'description',
        'website',
        'cover_title',
        'cover_desc',
        'parent_name',
        'permanent_address',
        'dob',
        'language_known',
        'nationality',
        'primary_account'

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
        return JobSeekerDetail::class;
    }

    public function sync($input = [], $user)
    {
        $seekerDetail = !empty($user->seekerDetail) ? $user->seekerDetail : $this->makeModel();

        $seekerDetail->fill($input);
        $seekerDetail->save();
        return $seekerDetail;
    }

    public function getJobseekerIds($employerJob)
    {
        $jobAlerts = JobAlert::whereRaw('FIND_IN_SET(search_term, "' . str_replace(' ', ',', $employerJob->title) . '")')->where('location_id', $employerJob->location_id)->get();

        $ids = $jobAlerts->map(
            function ($items) {
                $data['id'] = $items->user_id;
                return $data;
            }
        );
        return $ids;
    }

    public function createInputDataForProfilePdf($seekerDetailId) {
        $input = [];

        //get created by user info

        $jobseeker = $this->find($seekerDetailId, ['*'], true);

        if (!empty($jobseeker)) {
            $input = $this->model->prepareInput($jobseeker);
        }

        return $input;
    }

    public function getCvPdfProfile($seekerDetailId)
    {
        $input = $this->createInputDataForProfilePdf($seekerDetailId);

        $input->file_name = $input->full_name;
        // dd(str_replace(' ', 'no-data', $input->file_name) . '-CV.pdf');
        $name = ($input->file_name == ' ') ? str_replace(' ', 'no-data', $input->file_name) . '-CV.pdf' : $input->file_name . '-CV.pdf';

        return FunctionHelper::prepareProfilPdf($input, 'users.make_a_cv_pdf_profile', true, true, $name);
    }
    // public function getCvPdfResume($seekerDetailId)
    // {
    //     $input = $this->createInputDataForProfilePdf($seekerDetailId);

    //     $input->file_name = $input->full_name;
    //     // dd(str_replace(' ', 'no-data', $input->file_name) . '-CV.pdf');
    //     $name = ($input->file_name == ' ') ? str_replace(' ', 'no-data', $input->file_name) . '-CV.pdf' : $input->file_name . '-CV.pdf';

    //     return FunctionHelper::prepareProfilPdf($input, 'users.make_a_cv_pdf_resume', true, true, $name);
    // }


    public function getCvPdfResume($seekerDetailId)
    {
        $input = $this->createInputDataForProfilePdf($seekerDetailId);

        // Assuming $input->resume_summary contains Markdown content
        $parsedown = new Parsedown();
        $input->resume_summary = $parsedown->text($input->resume_summary);

        $input->file_name = $input->full_name;
        $name = ($input->file_name == ' ') ? str_replace(' ', 'no-data', $input->file_name) . '-CV.pdf' : $input->file_name . '-CV.pdf';

        // Set the flag to false to prevent paragraphs and line breaks
        return FunctionHelper::prepareProfilPdf($input, 'users.make_a_cv_pdf_resume', false, false, $name);
    }

}
