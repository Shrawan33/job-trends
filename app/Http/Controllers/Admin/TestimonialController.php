<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TestimonialDataTable;
use App\Http\Requests\CreateTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Repositories\TestimonialRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DocumentRepository;
use Response;
use Throwable;

class TestimonialController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    private $documentRepository;
    private $disk = 'testimonials';

    public function __construct(TestimonialRepository $testimonialRepo, DocumentRepository $docRepo)
    {
        $this->repository = $testimonialRepo;
        $this->getEntity('testimonials');
        $this->documentRepository = $docRepo;
        $this->documentRepository->setDisk($this->disk);
    }

    /**
     * Display a listing of the Testimonial.
     *
     * @param TestimonialDataTable $testimonialDataTable
     * @return Response
     */
    public function index(TestimonialDataTable $testimonialDataTable)
    {
        return $testimonialDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Testimonial.
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
     * Store a newly created Testimonial in storage.
     *
     * @param CreateTestimonialRequest $request
     *
     * @return Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        try {
            $input = $request->all();

            $testimonial = $this->repository->create($input);

			$images = $request->get('test_images', []);
			$doc_type = config('constants.document_type.image', 0);
            $this->documentRepository->savePermanent($images, $doc_type, $testimonial);

            Flash::success($this->entity['singular'] . ' saved successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified Testimonial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $testimonial = $this->repository->find($id, ['*'], true);

            if (empty($testimonial)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['testimonial' => $testimonial, 'entity' => $this->entity, 'imageModel' => $testimonial]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified Testimonial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $testimonial = $this->repository->find($id, ['*'], true);

            if (empty($testimonial)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['testimonial' => $testimonial, 'entity' => $this->entity, 'imageModel' => $testimonial]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified Testimonial in storage.
     *
     * @param  int              $id
     * @param UpdateTestimonialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTestimonialRequest $request)
    {
        try {
            $testimonial = $this->repository->find($id, ['*'], true);

            if (empty($testimonial)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $testimonial = $this->repository->update($request->all(), $id, true);

			// images
            $images = $request->get('test_images', []);
            $doc_type = config('constants.document_type.image', 0);
            $this->documentRepository->savePermanent($images, $doc_type, $testimonial);

            Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}
