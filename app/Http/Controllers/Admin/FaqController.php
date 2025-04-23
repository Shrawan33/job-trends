<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FaqDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Repositories\FaqRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class FaqController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->repository = $faqRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Faq.
     *
     * @param FaqDataTable $faqDataTable
     * @return Response
     */
    public function index(FaqDataTable $faqDataTable)
    {
        return $faqDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Faq.
     *
     * @return Response
     */
    public function create()
    {
        
        try {
            $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity])->render();

            return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Store a newly created Faq in storage.
     *
     * @param CreateFaqRequest $request
     *
     * @return Response
     */
    public function store(CreateFaqRequest $request)
    {
    
        try {
            $input = $request->all();
            $faq = $this->repository->create($input);
            return $this->sendResponse($faq, $this->entity['singular'] . ' saved successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Display the specified Faq.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        
        try {
            $faq = $this->repository->find($id, ['*'], true);

            if (empty($faq)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['faq' => $faq, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
                }
            } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified Faq.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
       
        try {
            $faq = $this->repository->find($id, ['*'], true);

            if (empty($faq)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.edit', ['faq' => $faq, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Update the specified Faq in storage.
     *
     * @param  int              $id
     * @param UpdateFaqRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFaqRequest $request)
    {
      

        try {
            $faq = $this->repository->find($id, ['*'], true);

            if (empty($faq)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $faq = $this->repository->update($request->all(), $id, true);

                return $this->sendResponse($faq, $this->entity['singular'] . ' updated successfully.');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }
}
