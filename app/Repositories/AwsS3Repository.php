<?php

namespace App\Repositories;

use App\Repositories\AwsS3\AwsS3Interface as AwsS3Interface;
use Aws\S3\Exception\S3Exception;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;
use Illuminate\Http\File;
use Illuminate\Filesystem\FilesystemManager as Storage;

class AwsS3Repository implements AwsS3Interface
{
    public $storage;
    public $disk;

    /**
     * Contructor
     *
     * @param Storage $storage
     */
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * setDisk function
     *
     * @param string $disk = 's3' or 'customer' according to config file filesystems.
     * @return void
     */
    public function setDisk($disk = 's3')
    {
        $this->storage->disk($disk);
        $this->disk = $disk;
    }

    /**
     * getDisk function
     *
     * @return void
     */
    public function getDisk()
    {
        return $this->disk ?? 's3';
    }

    /**
     * getSize function
     *
     * @param string $file
     * @return void
     */
    public function getSize(string $file)
    {
        $size = 0;
        if ($this->fileExists($file)) {
            $size = $this->storage->disk($this->getDisk())->size($file);
        }
        return $size;
    }

    /**
     * getMimeType function
     *
     * @param string $file
     * @return void
     */
    public function getMimeType(string $file)
    {
        $mime = '';
        if ($this->fileExists($file)) {
            $mime = $this->storage->disk($this->getDisk())->mimeType($file);
        }
        return $mime;
    }

    /**
     * upload function
     *
     * @param string $path
     * @param string $filename
     * @param string $file
     * @param string $from
     * @return string public url of the file.
     */
    public function upload($path = '', $filename, $file)
    {
        $filepath = $path ? $path . '/' . $filename : $filename;
        $this->storage->disk($this->getDisk())->put($filepath, $file);
        return $filepath;
    }

    /**
     * uploadBase64 function
     *
     * @param string $path
     * @param string $filename
     * @param string $file
     * @param string $from
     * @return string public url of the file.
     */
    public function uploadBase64($path = '', $filename, $file)
    {
        $filepath = $path ? $path . '/' . $filename : $filename;
        $this->storage->disk($this->getDisk())->put($filepath, base64_decode($file));
        return $filepath;
    }

    /**
     * url function
     *
     * @param string $filepath 'images/1234578ABC.jpeg'.
     * @return string public url of the file.
     */
    public function url($filepath)
    {
        return $this->storage->disk($this->getDisk())->url($filepath);
    }

    /**
     * presignedUrl function
     *
     * @param string $filepath 'images/1234578ABC.jpeg'.
     * @return string presigned url of the file.
     */
    public function presignedUrl($filepath)
    {
        $disk = $this->getDisk();
        $storage = config("filesystems.disks.$disk");
        $s3Client = new S3Client($storage);

        $command = $s3Client->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $storage['root'] . '/' . $filepath,
        ]);

        $request = $s3Client->createPresignedRequest($command, '+20 minutes');

        return (string) $request->getUri();
    }

    public function getDownloadUrl($filepath)
    {
        $disk = $this->getDisk();
        $storage = config("filesystems.disks.$disk");
        $s3Client = new S3Client($storage);

        $result = $s3Client->getObject([
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $storage['root'] . '/' . $filepath,
        ]);
        // dd($result);

        return $result;
    }

    public function getFile($filename = '')
    {
        return $this->storage->disk($this->getDisk())->get($filename);
    }

    /**
     * delete function
     *
     * @param string $filepath 'images/1234578ABC.jpeg'.
     * @return void
     */
    public function delete($filepath)
    {
        return $this->storage->disk($this->getDisk())->delete($filepath);
    }

    /**
     * fileExists function
     *
     * @param string $filepath
     * @return void
     */
    public function fileExists($filepath)
    {
        return $this->storage->disk($this->getDisk())->exists($filepath);
    }

    /**
     * deleteDirectory function
     *
     * @param string $filepath
     * @return void
     */
    public function deleteDirectory($filepath)
    {
        return $this->storage->disk($this->getDisk())->deleteDirectory($filepath);
    }

    /**
     * putFileFromLocaltoS3 function
     *
     * @param string $sourcepath
     * @param [type] $destinationpath
     * @param [type] $filename
     * @return void
     */
    public function putFileFromLocaltoS3($sourcepath, $destinationpath, $filename)
    {
        $this->storage->disk($this->getDisk())->putFileAs($destinationpath, new File($sourcepath), $filename);
    }

    /**
     * multipartUpaloader function
     *
     * @param array $filenames_array
     * @return void
     */
    public function multipartUpaloader($filenames_array)
    {
        $disk = $this->getDisk();
        $storage = config("filesystems.disks.$disk");
        $s3Client = new S3Client($storage);

        $promises = [];
        // Compose promises:
        foreach ($filenames_array as $keyToFile => $pathToFile) {
            // $awsS3Folder = env('AWS_FOLDER', 'local');
            // $filepath = $keyToFile;
            $uploader = new MultipartUploader($s3Client, $pathToFile, [
                'bucket' => env('AWS_BUCKET'),
                'key' => $keyToFile,
                'concurrency' => 25,
            ]);
            $promises[] = $uploader->promise();
        }
        // Execute upload:
        $aggregate = \GuzzleHttp\Promise\all($promises);

        try {
            $result = $aggregate->wait();
        } catch (S3Exception $e) {
            // Handle the error
            // echo $e->getMessage();
        }
        return $result;
    }

    /**
     * deleteAll function
     *
     * @param string $path
     * @return void
     */
    public function deleteAll($path)
    {
        $disk = $this->getDisk();
        $storage = config("filesystems.disks.$disk");
        $s3Client = new S3Client($storage);
        return $s3Client->deleteMatchingObjects(env('AWS_BUCKET'), $path);
    }

    public function copyFile($sourcepath, $destinationpath, $preserveSource = false)
    {
        if ($this->fileExists($sourcepath)) {
            $this->storage->disk($this->getDisk())->copy($sourcepath, $destinationpath);
            if ($preserveSource === false) {
                $this->delete($sourcepath);
            }
        }
    }
}
