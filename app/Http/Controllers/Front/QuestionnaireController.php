<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\EmployerJob;
use App\Repositories\QuestionnaireRepository;
use Response;
use Throwable;

class QuestionnaireController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(QuestionnaireRepository $questionnaireRepo)
    {
        $this->repository = $questionnaireRepo;
        $this->getEntity();
    }

    /**
     * Show the form for creating a new ApplyJob.
     *
     * @return Response
     */
    public function create($job)
    {
        try {
            $questionnaire = EmployerJob::getQuestionnaireSession($job);

            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity, 'job' => $job, 'questionnaire' => $questionnaire])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Store a newly created ApplyJob in storage.
     *
     * @param CreateEmployerJobRequest $request
     *
     * @return Response
     */
    public function store(Request $request, $job)
    {
        try {
            $questionnaire = $this->prepareInput($request->get('questionnaire', []));

            EmployerJob::setQuestionnaireSession($job, $questionnaire);

            $request->refreshContentId = 'questionnaire-list';
            $request->refreshContent = view('questionnaires.list', ['job' => $job, 'list' => $questionnaire, 'display' => true])->render();

            return $this->sendResponse($request, 'Questionnaire added/updated successfully');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    private function prepareInput($input = [])
    {
        return !empty($input) ? collect($input)->filter(function ($item) { return isset($item['title']) && $item['title'] != ''; })->all() : [];
    }

    public function removeQuestion(Request $request, $job)
    {
        $id = $request->get('key', null);
        if ($id != null) {
            $questionnaire = EmployerJob::getQuestionnaireSession($job);
            $filtered = $questionnaire->filter(function ($question, $key) use ($id) {
                return $key != $id;
            });

            $questionnaireList = $filtered->count() > 0 ? array_values($filtered->all()) : [];
            $result = EmployerJob::setQuestionnaireSession($job, $questionnaireList);

            $response['refreshContentId'] = 'questionnaire-list';
            $response['refreshContent'] = view('questionnaires.list', ['job' => $job, 'list' => $result, 'display' => true])->render();

            return $this->sendResponse($response, 'Question removed successfully');
        }
        return $this->sendResponse(['callbackFunction' => "$(this).parents('.question-item').remove();"], 'Question removed successfully');
    }
}
