<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OrderDetailRepository;
use Illuminate\Http\Request;
use Response;
use Throwable;

class OrderController extends AppBaseController
{
    /** @var  $repository */
    public $repository;

    public function __construct(OrderDetailRepository $orderRepo)
    {
        $this->repository = $orderRepo;
        $this->getEntity();
    }

    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     * @return Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Order.
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
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        try {
            $input = $request->all();

            $order = $this->repository->create($input);

            Flash::success($this->entity['singular'] . ' saved successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $order = $this->repository->find($id, ['*'], true);

            if (empty($order)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['order' => $order, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $order = $this->repository->find($id, ['*'], true);

            if (empty($order)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['order' => $order, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        try {
            $order = $this->repository->find($id, ['*'], true);

            if (empty($order)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $order = $this->repository->update($request->all(), $id, true);

            Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function markAsPending($id, Request $request)
    {
        try {
			$order = $this->repository->find($id, ['*'], true);

            if (empty($order)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $input['order_process_status'] = 0;
                $order = $this->repository->update($input, $id, true);
                Flash::success($this->entity['singular'] . ' marked as pending.');
                return redirect(route($this->entity['url'] . '.index'));
            }
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

	public function markAsCompleted($id, Request $request)
    {
        try {
			$order = $this->repository->find($id, ['*'], true);

            if (empty($order)) {
                return $this->sendError($this->entity['singular'] . ' not found');
            } else {
                $input['order_process_status'] = 1;
                $order = $this->repository->update($input, $id, true);
                Flash::success($this->entity['singular'] . ' marked as completed.');
                return redirect(route($this->entity['url'] . '.index'));
            }
        } catch (Throwable $e) {
            throw $e;
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    public function downloadOrders($id)
    {
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
