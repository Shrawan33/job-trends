<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\AppBaseController;
use App\Imports\CategorySheetmport;
use App\Repositories\DocumentRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Throwable;

class CategoryController extends AppBaseController
{
    private $documentRepository;
    private $disk = 'categories';

    public function __construct(CategoryRepository $categoryRepo, DocumentRepository $docRepo)
    {
        $this->repository = $categoryRepo;
        $this->getEntity('categories');
        $this->documentRepository = $docRepo;
        $this->documentRepository->setDisk($this->disk);
        //$this->getEntity();
    }

    /**
     * Display a listing of the Category.
     *
     * @param CategoryDataTable $categoryDataTable
     * @return Response
     */
    public function index(CategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Category.
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
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        try {
            $input = $request->all();

            $category = $this->repository->create($input);

            // images
            $images = $request->get('icon_images', []);
            $doc_type = config('constants.document_type.image', 0);
            $this->documentRepository->savePermanent($images, $doc_type, $category);

            Flash::success($this->entity['singular'] . ' Saved Successfully');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $category = $this->repository->find($id, ['*'], true);

            if (empty($category)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $modal = view($this->entity['view'] . '.show', ['category' => $category, 'entity' => $this->entity])->render();

                return $this->sendResponse($modal, '');
            }
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode() == 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $category = $this->repository->find($id, ['*'], true);

            if (empty($category)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['category' => $category, 'entity' => $this->entity, 'imageModel' => $category]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        try {
            $category = $this->repository->find($id, ['*'], true);

            if (empty($category)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $category = $this->repository->update($request->all(), $id, true);

            // images
            $images = $request->get('icon_images', []);
			$doc_type = config('constants.document_type.image', 0);
            $this->documentRepository->savePermanent($images, $doc_type, $category);

            Flash::success($this->entity['singular'] . ' Updated Successfully');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function getParentCategories(Request $request)
    {
        $limit = config('constants.default_dd_limit', null);
        $search = ['name' => $request->get('term', ''), 'parent_id' => null];
        $exclude = $request->get('exclude', null);
        $data = $this->repository->all($search, null, $limit, ['id', 'title', 'title as text'], [], [], ['id' => $exclude]);
        return response()->json(['results' => $data]);
    }

    public function getImportfile()
    {
        $modal = view($this->entity['view'] . '.import')->render();

        return $this->sendResponse($modal, '');
    }

    public function import(Request $request)
    {
        if ($request->file('import_file') ?? false) {
            Excel::import(new CategorySheetmport, $request->file('import_file'));
            return $this->sendResponse([], 'Import successfully.');
        } else {
            return $this->sendError($this->entity['singular'] . ' import file not found');
        }
    }
}
