<?php

namespace App\Listeners;

use App\Repositories\DocumentRepository;
use Illuminate\Auth\Events\ImageSizeReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ImageSizeResetListener implements ShouldQueue
{
    private $documentRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    /**
     * Handle the event.
     *
     * @param  ImageSizeReset  $event
     * @return void
     */
    public function handle(ImageSizeReset $event)
    {
        //$this->documentRepository->makeUserContactVerified($event->userId, $event->verification);
        Log::info('Image resize event ', ['event' => $event]);
        //dd($event);
    }
}
