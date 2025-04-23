<?php

namespace App\Listeners;

use App\Events\ImageResize;
use App\Models\Document;
use App\Repositories\AwsS3\AwsS3Interface;
use App\Repositories\DocumentRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ImageResizeListener
{
    private $documentRepository;
    private $storage;
    private $disk = 'user';
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DocumentRepository $documentRepository, AwsS3Interface $storage)
    {
        $this->documentRepository = $documentRepository;
        $this->storage = $storage;
    }

    public function setDisk($disk = 's3')
    {
        $this->storage->setDisk($disk);
    }

    /**
     * Handle the event.
     *
     * @param  ImageResize  $event
     * @return void
     */
    public function handle(ImageResize $event)
    {
        $document_id = $event->documentObj;
        $documentObj = $this->documentRepository->find($document_id);
        $img = Document::resizeImage($documentObj->presigned_url, [100,100]);
        $this->setDisk($this->disk);
        $filename_array = explode('.', $documentObj->file_name);
        $file_name = $filename_array[0].'_thumbnail'.'.'.$filename_array[1];
        $file_path_name = $this->storage->uploadBase64('', $file_name, base64_encode($img));
        Log::info('Uploaded ', ['FilePath' => $file_path_name]);
    }
}
