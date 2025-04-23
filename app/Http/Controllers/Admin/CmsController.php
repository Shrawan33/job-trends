<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CmsDatatable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCmsRequest;
use App\Http\Requests\UpdateCmsRequest;
use App\Repositories\CmsRepository;
use Laracasts\Flash\Flash;
use Response;
use Throwable;

class CmsController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(CmsRepository $cmsRepository)
    {
        $this->repository = $cmsRepository;
        $this->getEntity();
    }

    /**
     * Display a listing of the Cms.
     *
     * @param CmsDatatable $cmsDatatable
     * @return Response
     */
    public function index(CmsDatatable $cmsDatatable)
    {
        return $cmsDatatable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Cms.
     *
     * @return Response
     */
    public function create()
    {
        try {
            // $modal = view($this->entity['view'] . '.create', ['entity' => $this->entity])->render();
            return view($this->entity['view'] . '.create', ['entity' => $this->entity]);

            // return $this->sendResponse($modal, '');
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Store a newly created Cms in storage.
     *
     * @param CreateCmsRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsRequest $request)
    {
        // try {
        //     $input = $request->all();

        //     $cms = $this->repository->create($input);

        //     return $this->sendResponse($cms, $this->entity['singular'] . ' saved successfully.');
        // } catch (Throwable $e) {
        //     return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        // }
        try {
            $input = $request->all();

            $cms = $this->repository->create($input);

            Flash::success($this->entity['singular'] . ' saved successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified Cms.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //         try {
        //             $cms = $this->repository->find($id, ['*'], true);
        // // dd($cms);
        //             if (empty($cms)) {
        //                 return $this->sendError($this->entity['singular'] . ' not found');
        //             } else {
        //                 $modal = view($this->entity['view'] . '.show', ['cms' => $cms, 'entity' => $this->entity])->render();

        //                 return $this->sendResponse($modal, '');
        //             }
        //         } catch (Throwable $e) {
        //             return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        //         }
        try {
            $cms = $this->repository->find($id, ['*'], true);
            // dd($cms);
            if (empty($cms)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['cms' => $cms, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified Cms.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // try {
        //     $cms = $this->repository->find($id, ['*'], true);

        //     if (empty($cms)) {
        //         return $this->sendError($this->entity['singular'] . ' not found');
        //     } else {
        //         $modal = view($this->entity['view'] . '.edit', ['cms' => $cms, 'entity' => $this->entity])->render();

        //         return $this->sendResponse($modal, '');
        //     }
        // } catch (Throwable $e) {
        //     return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        // }

        try {
            $cms = $this->repository->find($id, ['*'], true);

            if (empty($cms)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['cms' => $cms, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified Cms in storage.
     *
     * @param  int              $id
     * @param UpdateCmsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsRequest $request)
    {
        // try {
        //     $cms = $this->repository->find($id, ['*'], true);

        //     if (empty($cms)) {
        //         return $this->sendError($this->entity['singular'] . ' not found');
        //     } else {
        //         $cms = $this->repository->update($request->all(), $id, true);

        //         return $this->sendResponse($cms, $this->entity['singular'] . ' updated successfully.');
        //     }
        // } catch (Throwable $e) {
        //     return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        // }

        try {
            $cms = $this->repository->find($id, ['*'], true);

            if (empty($cms)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $cms = $this->repository->update($request->all(), $id, true);

            Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}
