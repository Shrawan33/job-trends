<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EventDataTable;
use App\Helpers\SeoHelper;
use App\Helpers\SitemapHelper;
use App\Http\Requests;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepository;
use App\Repositories\DocumentRepository;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;

use Response;
use Throwable;

class EventController extends AppBaseController
{
    /** @var  $repository */
    public $repository;
    private $documentRepository;
    private $disk = 'events';
    public function __construct(EventRepository $eventRepo, DocumentRepository $docRepo)
    {
        $this->repository = $eventRepo;
        $this->getEntity('events');
        $this->documentRepository = $docRepo;
        $this->documentRepository->setDisk($this->disk);
    }

    /**
     * Display a listing of the Event.
     *
     * @param EventDataTable $eventDataTable
     * @return Response
     */
    public function index(EventDataTable $eventDataTable)
    {

        $meta = SeoHelper::getMeta('Events');

        return $eventDataTable->render($this->entity['view'] . '.index', ['entity' => $this->entity]);
    }

    /**
     * Show the form for creating a new Event.
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
     * Store a newly created Event in storage.
     *
     * @param CreateEventRequest $request
     *
     * @return Response
     */


    public function store(CreateEventRequest $request)
    {
        try {
            $input = $request->all();

            // Parse event_date
            $eventDate = Carbon::parse($input['event_date']);
            $input['event_date'] = $eventDate;

             // Save meta fields (optional fallback)
            $input['meta_title'] = $input['meta_title'] ?? '';
            $input['meta_description'] = $input['meta_description'] ?? '';

            // Create event using the modified $input array
            $event = $this->repository->create($input);

            // Handle image upload
            $images = $request->get('icon_images', []);
            $doc_type = config('constants.document_type.image', 0);
            $this->documentRepository->savePermanent($images, $doc_type, $event);

            // Flash message on successful creation
            Flash::success($this->entity['singular'] . ' saved successfully.');


            $eventRoute = [
                ["events/{$event->id}", '0.64'],
            ];

            SitemapHelper::addNewRoute($eventRoute);

            // Redirect to the index page for events
            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            // Handle exceptions
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }


    /**
     * Display the specified Event.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $event = $this->repository->find($id, ['*'], true);

            if (empty($event)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.show', ['event' => $event, 'entity' => $this->entity]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified Event.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $event = $this->repository->find($id, ['*'], true);

            if (empty($event)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            return view($this->entity['view'] . '.edit', ['event' => $event, 'entity' => $this->entity,'imageModel' => $event]);
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified Event in storage.
     *
     * @param  int              $id
     * @param UpdateEventRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventRequest $request)
    {
        try {
            $event = $this->repository->find($id, ['*'], true);

            if (empty($event)) {
                Flash::error($this->entity['singular'] . ' not found');

                return redirect(route($this->entity['url'] . '.index'));
            }

            $input = $request->all();

            // Set default SEO fields if not provided
            $input['meta_title'] = $input['meta_title'] ?? '';
            $input['meta_description'] = $input['meta_description'] ?? '';

            $event = $this->repository->update($input, $id, true);

            // Handle image upload
            $images = $request->get('icon_images', []);
			$doc_type = config('constants.document_type.image', 0);
            $this->documentRepository->savePermanent($images, $doc_type, $event);

            Flash::success($this->entity['singular'] . ' updated successfully.');

            return redirect(route($this->entity['url'] . '.index'));
        } catch (Throwable $e) {
            Flash::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}
