<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BannerManagementDataTable;
use App\Http\Requests\CreateBannerManagementRequest;
use App\Http\Requests\UpdateBannerManagementRequest;
use App\Repositories\BannerManagementRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DocumentRepository;
use Response;
use Throwable;
use Illuminate\Http\Request;

class BannerManagementController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    private $disk = 'banners';
    private $documentRepository;

    public function __construct(BannerManagementRepository $bannerManagementRepo, DocumentRepository $docRepo)
    {
        $this->repository = $bannerManagementRepo;
        $this->getEntity();
        $this->documentRepository = $docRepo;
        $this->documentRepository->setDisk($this->disk);
    }

    /**
     * Display a listing of the BannerManagement.
     *
     * @param BannerManagementDataTable $bannerManagementDataTable
     * @return Response
     */
    public function index(BannerManagementDataTable $bannerManagementDataTable)
    {
        return $bannerManagementDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new BannerManagement.
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
     * Store a newly created BannerManagement in storage.
     *
     * @param CreateBannerManagementRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();

            $banner = $this->repository->create($input);

            // images
            $images = $request->get('banner_images', []);
            $doc_type = config('constants.document_type.cropped_images', 2);
            $this->documentRepository->savePermanent($images, $doc_type, $banner);

            Flash::success($this->entity['singular'] . ' Saved Successfully');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified BannerManagement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $banner = $this->repository->find($id, ['*'], true);

            if (empty($banner)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['banner' => $banner, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified BannerManagement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $banner = $this->repository->find($id, ['*'], true);

            if (empty($banner)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['banner' => $banner, 'entity' => $this->entity, 'imageModel' => $banner]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified BannerManagement in storage.
     *
     * @param  int              $id
     * @param UpdateBannerManagementRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        try {
            $banner = $this->repository->find($id, ['*'], true);

            if (empty($banner)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $banner = $this->repository->update($request->all(), $id, true);

            // images
            $images = $request->get('banner_images', []);
            $doc_type = config('constants.document_type.cropped_images', 2);
            $this->documentRepository->savePermanent($images, $doc_type, $banner);

            Flash::success($this->entity['singular'] . ' Updated Successfully');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}
