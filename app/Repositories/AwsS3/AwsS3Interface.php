<?php

namespace App\Repositories\AwsS3;

interface AwsS3Interface
{
    public function setDisk(string $disk = 's3');

    public function getDisk();

    public function getSize(string $file);

    public function getMimeType(string $file);

    public function upload($path = '', $filename, $file);

    public function uploadBase64($path = '', $filename, $file);

    public function url($filepath);

    public function presignedUrl($filepath);

    public function getDownloadUrl($filepath);

    public function delete($filepath);

    public function fileExists($filepath);

    public function putFileFromLocaltoS3(string $sourcepath, string $destinationpath, string $filename);

    public function multipartUpaloader(array $filenames);

    public function deleteAll(string $path);

    public function copyFile(string $from, string $to, bool $preserve = false);

    public function getFile($filename = '');
}
