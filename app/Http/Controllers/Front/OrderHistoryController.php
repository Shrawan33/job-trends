<?php

namespace App\Http\Controllers\Front;

use App\DataTables\OrderHistoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrderHistoryRequest;
use App\Http\Requests\UpdateOrderHistoryRequest;
use App\Repositories\OrderHistoryRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DocumentRepository;
use App\Repositories\OrderDetailRepository;
use Response;
use Throwable;

class OrderHistoryController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    public $documentRepository;
    private $disk = 'order';

    public function __construct(OrderDetailRepository $orderHistoryRepo, DocumentRepository $documentRepo)
    {
        $this->repository = $orderHistoryRepo;
        $this->documentRepository = $documentRepo;
        $this->getEntity();
        $this->documentRepository->setDisk($this->disk);
    }

    /**
     * Display a listing of the OrderHistory.
     *
     * @param OrderHistoryDataTable $orderHistoryDataTable
     * @return Response
     */
    public function index(OrderHistoryDataTable $orderHistoryDataTable)
    {
        // dd($this->entity);
        return $orderHistoryDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new OrderHistory.
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
     * Store a newly created OrderHistory in storage.
     *
     * @param CreateOrderHistoryRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderHistoryRequest $request)
    {
        try {
            $input = $request->all();

            $orderHistory = $this->repository->create($input);

            Flash::success($this->entity['singular'] . ' saved successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified OrderHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $orderHistory = $this->repository->find($id, ['*'], true);

            if (empty($orderHistory)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['orderHistory' => $orderHistory, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified OrderHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $orderHistory = $this->repository->find($id, ['*'], true);

            if (empty($orderHistory)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['orderHistory' => $orderHistory, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified OrderHistory in storage.
     *
     * @param  int              $id
     * @param UpdateOrderHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderHistoryRequest $request)
    {
        try {
            $orderHistory = $this->repository->find($id, ['*'], true);

            if (empty($orderHistory)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $orderHistory = $this->repository->update($request->all(), $id, true);

            Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function downloadAttachment($id)
    {
        try {
            $order = $this->repository->find($id, ['*'], true);

            if (empty($order)) {
                return redirect(route($this->entity['url'] . '.index'))->withInput(['toast_error' => $this->entity['singular'] . ' not found']);
            }

            $orderDocument = isset($order->orderDocuments) ? $order->orderDocuments->first() : '';
            // dd($jobseekerDocument);
            if (empty($orderDocument)) {
                return redirect()->back()->withInput(['toast_error' => 'Attachment not found']);
            }

            $document = $this->documentRepository->find($orderDocument->id);

            if (empty($document)) {

                return redirect()->back()->withInput(['toast_error' => 'Attachment not found']);
            }
            //dd($document->file_path);
            $result = $this->documentRepository->downloadUrl($document->file_path);

            $extension = explode('.', $document->file_name);
            header('Content-length:' . $result['ContentLength']);
            header("Content-Type: {$result['ContentType']}");
            header('Content-Disposition: inline; filename="' . basename($order->user->full_name).'.'.end($extension).'"'); // used to download the file.

            echo $result['Body'];
            exit;
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
        }

        return redirect()->back();
    }

    public function downloadOrders($id)
    {
        // dd("hello");
        try {
            $order = $this->repository->find($id, ['*'], true);

            if (empty($order)) {
                return redirect(route($this->entity['url'] . '.index'))->withInput(['toast_error' => $this->entity['singular'] . ' not found']);
            }
            return $this->repository->getCvPdf($id);
        } catch (Throwable $e) {
            return redirect()->back()->withInput(['toast_error' => $e->getMessage()]);
        }
    }
}
