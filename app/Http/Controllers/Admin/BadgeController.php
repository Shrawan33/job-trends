<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BadgeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBadgeRequest;
use App\Http\Requests\UpdateBadgeRequest;
use App\Repositories\BadgeRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DocumentRepository;
use Response;
use Throwable;

class BadgeController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    private $documentRepository;
    private $disk = 'badges';

    public function __construct(BadgeRepository $badgeRepo, DocumentRepository $docRepo)
    {
        $this->repository = $badgeRepo;
        $this->getEntity('badges');
        $this->documentRepository = $docRepo;
        $this->documentRepository->setDisk($this->disk);
    }

    /**
     * Display a listing of the Badge.
     *
     * @param BadgeDataTable $badgeDataTable
     * @return Response
     */
    public function index(BadgeDataTable $badgeDataTable)
    {
        return $badgeDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Badge.
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
     * Store a newly created Badge in storage.
     *
     * @param CreateBadgeRequest $request
     *
     * @return Response
     */
    public function store(CreateBadgeRequest $request)
    {
        try {
            $input = $request->all();

            $badge = $this->repository->create($input);

            // images
            $images = $request->get('icon_images', []);
            $doc_type = config('constants.document_type.image', 0);
            $this->documentRepository->savePermanent($images, $doc_type, $badge);

            Flash::success($this->entity['singular'] . ' Saved Successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified Badge.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $badge = $this->repository->find($id, ['*'], true);

            if (empty($badge)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['badge' => $badge, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified Badge.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $badge = $this->repository->find($id, ['*'], true);

            if (empty($badge)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['badge' => $badge, 'entity' => $this->entity, 'imageModel' => $badge]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified Badge in storage.
     *
     * @param  int              $id
     * @param UpdateBadgeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBadgeRequest $request)
    {
        try {
            $badge = $this->repository->find($id, ['*'], true);

            if (empty($badge)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $badge = $this->repository->update($request->all(), $id, true);

            Flash::success($this->entity['singular'] . ' Updated Successfully');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        try {
            $badge = $this->repository->find($id, ['*'], true);

            if (empty($badge)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $badge = $this->repository->update($request->all(), $id, true);

            // images
            $images = $request->get('icon_images', []);
			$doc_type = config('constants.document_type.image', 0);
            $this->documentRepository->savePermanent($images, $doc_type, $badge);

            Flash::success($this->entity['singular'] . ' Updated Successfully');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}
