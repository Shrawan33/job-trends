<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PackageDataTable;
use App\Http\Requests\CreatePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Repositories\PackageRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Throwable;

class PackageController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(PackageRepository $packageRepo)
    {
        $this->repository = $packageRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Package.
     *
     * @param PackageDataTable $packageDataTable
     * @return Response
     */
    public function index(PackageDataTable $packageDataTable)
    {
        return $packageDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Package.
     *
     * @return Response
     */
    public function create()
    {
        try {
            return view($this->entity['view'] . '.create', ['entity' => $this->entity, 'roles' => ['jobseekers' => 'Jobseekers', 'employers' => 'Employers'], 'package_type_list' => config('constants.package_type'), 'employer_package_type_list' => config('constants.employer_package_type')]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Store a newly created Package in storage.
     *
     * @param CreatePackageRequest $request
     *
     * @return Response
     */
    public function store(CreatePackageRequest $request)
    {
        try {
            $input = $request->all();

            $input = $this->repository->prepareToJson($input);

            $package = $this->repository->create($input);

            Flash::success(trans('message.package_saved'));

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified Package.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $package = $this->repository->find($id, ['*'], true);

            if (empty($package)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['package' => $package, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified Package.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $package = $this->repository->find($id, ['*'], true);

            if (empty($package)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            // dd($package->credit_info, $package->sms);
            return view($this->entity['view'] . '.edit', ['package' => $package, 'entity' => $this->entity, 'roles' => ['employers' => 'Employers', 'jobseekers' => 'Jobseekers'], 'package_type_list' => config('constants.package_type'), 'employer_package_type_list' => config('constants.employer_package_type')]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified Package in storage.
     *
     * @param  int              $id
     * @param UpdatePackageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackageRequest $request)
    {
        try {
            $package = $this->repository->find($id, ['*'], true);

            if (empty($package)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $input = $this->repository->prepareToJson($request->all());
            $package = $this->repository->update($input, $id, true);

            Flash::success(trans('message.package_updated'));

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function getAddonList($package_category_id) {
        $record = $this->repository->all(['package_category_id' => $package_category_id, 'is_addon' => 1]);

        return view('components.addon_list', ['addOns' => $record]);
        // $record->refreshContentId = 'recordContainer';
        // $record->refreshContent = view('components.addon_list', ['addOns' => $record])->render();

        // $success_message ='';
        // return $this->sendResponse($record, $success_message);
    }
}
