<?php

namespace App\Http\Controllers\Front;

use App\Classes\ChatGpt;
use App\DataTables\ChatGptDataTable;
use Illuminate\Http\Request;
use App\Http\Requests\CreateChatGptRequest;
use App\Http\Requests\UpdateChatGptRequest;
//use App\Repositories\ChatGptRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\JobSeekerDetailRepository;
use App\Repositories\UserRepository;
use Response;
use Throwable;

class ChatGptController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    public $userRepository;
    public $jobseekerDetailRepository;

    public function __construct(UserRepository $userRepo, JobSeekerDetailRepository $jobseekerDetailRepo)
    {
        $this->jobseekerDetailRepository = $jobseekerDetailRepo;
        $this->userRepository = $userRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the ChatGpt.
     *
     * @param ChatGptDataTable $chatGptDataTable
     * @return Response
     */
    public function index(ChatGptDataTable $chatGptDataTable)
    {
        return $chatGptDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new ChatGpt.
     *
     * @return Response
     */
    public function create()
    {
        try {
            return view($this->entity['view'] . '.create', ['entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Store a newly created ChatGpt in storage.
     *
     * @param CreateChatGptRequest $request
     *
     * @return Response
     */
    public function store(CreateChatGptRequest $request)
    {
        try {
            $input = $request->all();

            $chatGpt = $this->repository->create($input);

            Flash::success($this->entity['singular'] . ' saved successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified ChatGpt.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $chatGpt = $this->repository->find($id, ['*'], true);

            if (empty($chatGpt)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['chatGpt' => $chatGpt, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified ChatGpt.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $chatGpt = $this->repository->find($id, ['*'], true);

            if (empty($chatGpt)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['chatGpt' => $chatGpt, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified ChatGpt in storage.
     *
     * @param  int              $id
     * @param UpdateChatGptRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChatGptRequest $request)
    {
        try {
            $chatGpt = $this->repository->find($id, ['*'], true);

            if (empty($chatGpt)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $chatGpt = $this->repository->update($request->all(), $id, true);

            Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
    public function getComplexCV(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $id = $input['id'] ?? 0;
        parse_str($input[0], $dataArray);

        $user = $this->jobseekerDetailRepository->find($dataArray['seeker_id']);
        $user->refreshContentId = null;
        $user->refreshContent = null;
        $experienceMessage = $this->constructExperienceMessage($user, $dataArray['experience_summary']);
        $responses = (new ChatGpt())->sendMessage($experienceMessage);
        $user->refreshContentId = 'open-ai-contents';
        $user->refreshContent = $responses;
        return $this->sendResponse($user, trans('message.ai_generated_description'));


        $message = $input['editorValueName'] . ". Please provide in proper text in short.";
    }

    public function getCV(Request $request)
    {
        $input = $request->input();
        parse_str($input[0], $dataArray);

        $user = $this->jobseekerDetailRepository->find($dataArray['seeker_id']);
        $user->refreshContentId = null;
        $user->refreshContent = null;
        $message = $this->constructResumeSummaryMessage($user, $dataArray['resume_summary']);
        $response = (new ChatGpt())->sendMessage($message);
        $user->refreshContentId = 'open-ai-resume';
        $user->refreshContent = $response;

        return $this->sendResponse($user, trans('message.ai_generated_description'));
    }

    protected function constructResumeSummaryMessage($user, $resumeSummary)
    {
        $skills = [];
        if ($user->seekerSkill) {
            foreach ($user->seekerSkill as $key => $skill) {
                $skills[] = $skill->skill->title;
            }
        }
        $skill_string = implode(', ', $skills);

        $message = "First Name: " . $user->first_name . "\n";
        $message .= "Middle Name: " . $user->middle_name . "\n";
        $message .= "Last Name: " . $user->last_name . "\n";
        $message .= "Email: " . $user->email . "\n";
        $message .= "Phone Number: " . $user->phone . "\n";
        $message .= "Location: " . $user->address . "\n";
        $message .= "Linkedin URL: " . $user->linkedin_url ?? '' . "\n";
        $message .= "Blog URL: " . $user->blog_url ?? '' . "\n";
        $message .= "Social Link: " . $user->social_links ?? '' . "\n";
        $message .= "Who are you: " . $user->who_are_you . "\n";
        $message .= "Prominent Expertise" . $user->who_are_you. "\n";
        $message .= "My Core Competencies Are: " . $user->my_core_competencies . "\n";
        $message .= "I Am Searching For / Applying To This Role ". $user->searching_for . "\n";
        // $message .= "Key Skills: ".$skill_string."\n"; /* Key Skill removed as per client comment on 16th May */

        $experienceMessage = "Professional Experience: "."\n".$this->constructExperienceMessage($user, $user->seekerExperience);

        $educationMessage = "Education: "."\n".$this->constructEducationMessage($user);

        $certifications = "Certifications: "."\n".$this->constructCertificationMessage($user);

        $training = "Training Name: " . $user->training_name . "<br>";
        $training .= "Training Attended Company: " . $user->attended_at_company . "<br>";
        $training .= "Training taken year: " . $user->year . "<br>";

        //$message . 'resume_summary' . ". Craft a professional resume summary and enhance key skills based on the provided profile. Ensure the summary is tailored for the targeted job role, written in an accomplishment-driven manner to capture recruiters' attention. Avoid the use of personal pronouns and ensure the language is refined. Refrain from direct copying; instead, reword, enhance, and edit the information to include all pertinent details. Focus solely on delivering an effective summary and key skills to meet recruiters' expectations.";
        $context = "Using the client-provided information, prepare a detailed and professional resume of full two pages. Ensure to add all information provided by client, nothing should be missed. Ensure to:
            1. Include Client Basic Information: Automatically organize provided personal details at the resume's top. Keep Name in font size: 14, then use second line to add Email | Contact Number and Third Line LinkedIn and Other Links. Ensure that if any standard information is missing, proceed without adding placeholders.
            2. Craft a Profile Summary: Use the client's summary as a base, Do not copy directly. Rewrite, add, and enhance the summary. Do not use personal pronouns, name, candidate, this, etc. Use unique action verbs. Write at least two detailed paragraphs. If specifics are lacking, enhance based on the general role they're targeting. Integrate key skills and achievements relevant to their desired job.
            3. Write Core Competencies: List the client's 9 to 12 prominent core competencies keywords in three columns for ATS purpose based on their experience and the targeted job.
            4. Enumerate Key Skills: List the client's skills and add additional role-specific skills in an accomplishment driven manner based on their experience and the targeted job. Add skill headings and aim for a comprehensive showcase of their capabilities.
            5. Detail Professional Experience write in bullet point: For each listed experience, include organization, location, designation, and dates. If job roles are not specified, infer and add common responsibilities and achievements based on the client's title and industry. Write minimum 8 sentences and above in an accomplishment driven manner holding two lines in each sentence. Use action verbs and, where possible, quantify achievements.
            6. Education, Certification, and Training: List these details as provided. Highlight any particularly relevant to the job target.
            7. Incorporate Technical Skills if needed: Based on the client's industry and job target, list their technical skills or add general IT skills relevant to modern workplaces.
            8. Add Personal Statement: Write a small personalized paragraph at last to showcase why the client is super fit for job role he/she is applying to.
            9. Exclude Non-Provided Sections: Note this very Important: If the client hasn't provided information for a standard resume section, omit that section to maintain focus and relevance.
            Please tailor the content to avoid duplication and ensure that each section of the resume is directly aligned with the client's professional background and the specific job they are targeting. The goal is to create a personalized, impactful resume that highlights the client's unique qualifications and experiences. Please provide a response without any introductory or concluding explanations, just the direct content or answer.";
        //dd($message."\n".$experienceMessage."\n".$educationMessage."\n".$certifications."\n".$context);
        return $message."\n".$experienceMessage."\n".$educationMessage."\n".$certifications."\n".$training."\n".$context;
    }

    protected function constructExperienceMessage($user, $experienceSummary)
    {
        $experienceMessage = "";
        if ($user->seekerExperience) {
            foreach ($user->seekerExperience as $experience) {
                if ($experience->currently_working == 1) {
                    $experienceMessage .=
                        "Company:" . $experience->company. "\n" .
                        "Role/Achievevment: " . $experience->description . "\n" .
                        "Joining Month: " . $experience->from_month . "\n" .
                        "From Date: " . $experience->duration_from . "\n" .
                        "Leaving Month: Currently Present \n" .
                        "To Date: Currently Present \n \n" ;
                } else {
                    $experienceMessage .=
                        "Company:" . $experience->company. "\n" .
                        "Role/Achievevment: " . $experience->description . "\n" .
                        "Joining Month: " . $experience->from_month . "\n" .
                        "From Date: " . $experience->duration_from . "\n" .
                        "Leaving Month: " . $experience->to_month . "\n" .
                        "To Date: " . $experience->duration_to . "\n \n" ;
                }
                //dD($experience);


            }
        }
        return $experienceMessage;
    }

    protected function constructEducationMessage($user) {
        $educationMessage = "";
        if ($user->seekerEducation) {
            foreach ($user->seekerEducation as $education) {
                $educationMessage .=
                    "Degree:" . $education->qualification->title. "\n" .
                    "Joining Month: " . $education->from_month . "\n" .
                    "Joining Year: " . $education->duration_from . "\n" .
                    "Leaving Month: " . $education->to_month . "\n" .
                    "Leaving Year: " . $education->duration_to . "\n \n" ;
            }
        }
        return $educationMessage;
    }

    protected function constructCertificationMessage($user) {
        $certificationMessage = '';
        if ($user->seekerLicense) {
            foreach ($user->seekerLicense as $license) {
                $certificationMessage .=
                    "Certificate Name:" . $license->certificate_name. "\n" .
                    "Certifying Authority: " . $license->certifying_authority . "\n" .
                    "Month Year / Valid / Expired: " . $license->from_month .",".$license->from_year. "\n \n" ;
                }
        }
        return $certificationMessage;
    }
}
