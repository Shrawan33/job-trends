<?php

namespace App\Repositories;

use App\Events\ImageResize;
use Illuminate\Container\Container as Application;
use App\Models\Document;
use App\Repositories\AwsS3\AwsS3Interface;
use Illuminate\Auth\Events\ImageSizeReset;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class DocumentRepository
 * @package App\Repositories
 * @version January 22, 2021, 11:24 am UTC
*/

class DocumentRepository extends BaseRepository
{
    private $storage;

    public function __construct(Application $app, AwsS3Interface $storage)
    {
        parent::__construct($app);
        $this->storage = $storage;
    }

    public function setDisk($disk = 's3')
    {
        $this->storage->setDisk($disk);
    }

    public function getEndpoint()
    {
        return $this->storage->url('');
    }

    public function getFile($filename = '')
    {
        $file = $this->storage->getFile($filename);
        return !empty($file) ? base64_encode($file) : '';
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'file_name',
        'updated_by',
        'created_by',
        'is_deleted',
        'deleted_at'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Document::class;
    }

    /**
     * saveTemp function
     *
     * @param string $name
     * @param string $filecontent
     * @return void
     */
    public function saveTemp(string $name, string $filecontent)
    {
        $this->storage->upload('tmp', $name, $filecontent);
        $filepath = 'tmp' . '/' . $name;
        return [
            'name' => $name,
            'file_name' => $name,
            'url' => $this->storage->presignedUrl($filepath),
            'file_path' => $filepath,
            'size' => $this->storage->getSize($filepath),
            'mime_type' => $this->storage->getMimeType($filepath),
        ];
    }

    /**
     * deleteTempDocuments function
     *
     * @param string $filename
     * @param string $disk
     * @return void
     */
    public function deleteTemp(string $filename)
    {
        // delete temp documents
        if ($this->storage->fileExists('tmp/' . $filename)) {
            $this->storage->delete('tmp/' . $filename);
        }
    }

    private function prepareDocumentData($images)
    {
        $documents = [];
        if (isset($images['image'])) {
            foreach ($images['image'] as $key => $image) {
                $documents[$key]['id'] = $images['id'][$key];
                $documents[$key]['image'] = $image;
            }
        }
        return $documents;
    }

    private function prepareDocuments($documents, $document_type)
    {
        $newDocuments = [];
        $exists = [];
        switch ($document_type) {
            case '0': // images for logo
            case '2': // images with slider
                $documents = $this->prepareDocumentData($documents);
                $exists = collect($documents)->filter(function ($item) { return $item['id'] != '' && $item['id'] > 0; })->pluck('id')->toArray();
                $newDocuments = collect($documents)->whereNotIn('id', $exists)->transform(function ($item) {
                    return ['name' => uniqid('image_') . '.png', 'file' => $this->model()::getFileOject($item['image'])];
                })->all();
                break;
            case '1': // document file
            case '3': // video file
            case '4': // audio file
            case '5': // cover letter file
            case '6': // order document file
                $exists = collect($documents)->filter(function ($item) { return $item['id'] != '' && (int)$item['id'] > 0; })->pluck('id')->toArray();
                $newDocuments = collect($documents)->whereNotIn('id', $exists)->all();
                break;
        }
        return ['new' => $newDocuments, 'exists' => $exists];
    }

    public function getMorphObject(Model $modelObj, $document_type = '1', $return = 'save')
    {
        switch ($document_type) {
            case '0': // images for logo
                $document = $return == 'save' ? $modelObj->logo() : $modelObj->logo;
                break;
            case '2': // images with slider
                $document = $return == 'save' ? $modelObj->images() : $modelObj->images;
                break;
            case '1': // document
                $document = $return == 'save' ? $modelObj->documents() : $modelObj->documents;
                break;
            case '3':
                $document = $return == 'save' ? $modelObj->videos() : $modelObj->videos;
                break;
            case '4':
                $document = $return == 'save' ? $modelObj->audios() : $modelObj->audios;
                break;
            case '5':
                $document = $return == 'save' ? $modelObj->coverDocuments() : $modelObj->coverDocuments;
                break;
            case '6':
                $document = $return == 'save' ? $modelObj->orderDocuments() : $modelObj->orderDocuments;
                break;
        }
        return $document;
    }

    public function savePermanent(array $tempDocuments, int $document_type, Model $modelObj, $source_root = 'tmp', $action = null)
    {
        $documents = $this->prepareDocuments($tempDocuments, $document_type);

        $morphObj = $this->getMorphObject($modelObj);

        // dd($documents);
        if (!empty($documents['new'])) {
            foreach ($documents['new'] as $file) {
                if (in_array($document_type, [1, 3, 4, 5, 6])) { // for document / video
                    if ((isset($file['file_path']) && \Illuminate\Support\Str::startsWith($file['file_path'], 'tmp/')) || (in_array($action, ['convert', 'clone', 'revision']))) {
                        $source = ($source_root ?? 'tmp') . '/' . $file['file_name'];
                        $file_path_name = str_replace($source_root, $modelObj->id, $source);
                        if ($this->storage->fileExists($source)) {
                            $this->storage->copyFile($source, $file_path_name, $source_root != 'tmp');
                        }
                    }
                } else {
                    $filename = $file['name'];
                    $file_path_name = $this->storage->uploadBase64($modelObj->id, $filename, $file['file']);

                }
                if (isset($file_path_name)) {
                    $data = [
                        'file_name' => $file_path_name,
                        'size' => $this->storage->getSize($file_path_name),
                        'mime_type' => $this->storage->getMimeType($file_path_name),
                        'disk' => $this->storage->getDisk(),
                        'document_type' => $document_type
                    ];

                    $documentObj = (new $this->model())->fill($data);

                    // save object
                    $document = $morphObj->save($documentObj);

                    $documents['exists'][] = $document->id;

                    if (!in_array($document_type, [1, 3, 4, 5, 6])) { // for image
                        event(new ImageResize($document->id, $modelObj));
                    }
                }
            }
        }
        // detach the files
        $records = $this->getMorphObject($modelObj, $document_type, 'retrieve')->whereNotIn('id', $documents['exists']);
        if ($records->count() > 0) {
            $this->deleteDocuments($records);
        }

        return $documents['exists'] ?? [];
    }

    /**
     * deleteDocuments function
     *
     * @param collection $excludeDocs
     * @return void
     */
    public function deleteDocuments($documents)
    {
        // delete removed documents
        foreach ($documents as $document) {
            // remove files on S3
            if ($this->storage->fileExists($document->file_name)) {
                $this->storage->delete($document->file_name);
            }
            // remove files from DB
            $document->forceDelete();
        }
    }

    public function fileExists($filepath = null)
    {
        return $filepath != null ? $this->storage->fileExists($filepath) : false;
    }

    public function downloadUrl($file_path = null)
    {
        throw_if($this->fileExists($file_path) == false, FileNotFoundException::class, 'File not Found');
        return $this->storage->getDownloadUrl($file_path);
    }

    public function makeThumbnail() {
        //dd($this->model);
        return $this->model->where('disk', 'user')->whereIn('document_type', [0,2])->where('deleted_at', null)->where('is_deleted', 0)->get();
    }
}
