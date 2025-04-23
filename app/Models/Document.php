<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;

    public $table = 'documents';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];
    protected $appends = ['name', 'file_path',  'presigned_url'];
    public $fillable = [
        'file_name',
        'size',
        'mime_type',
        'disk',
        'document_type',
        'documentable_id',
        'documentable_type',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'file_name' => 'string',
        'size' => 'string',
        'mime_type' => 'string',
        'disk' => 'string',
        'document_type' => 'string',
        'documentable_id' => 'integer',
        'documentable_type' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'file_name' => 'required',
    ];

    public function documentable()
    {
        return $this->morphTo();
    }

    /**
     * Get file path for the document.
     *
     * @return bool
     */
    public function getFilePathAttribute()
    {
        return $this->attributes['file_name'];
    }

    /**
     * Get file path for the document.
     *
     * @return bool
     */
    public function getNameAttribute()
    {
        return str_replace($this->documentable_id . '/', '', $this->attributes['file_name']);
    }

    /**
     * Get presigned url for the document.
     *
     * @return bool
     */
    public function getPresignedUrlAttribute()
    {
        $awsS3Repo = \App\Helpers\FunctionHelper::getRepositoryByModule('awss3');
        $awsS3Repo->setDisk($this->disk);
        return $awsS3Repo->presignedUrl($this->file_name);
    }

    /**
     * Get presigned url for the document.
     *
     * @return bool
     */
    public function getPresignedthumbnailUrlAttribute()
    {
        $awsS3Repo = \App\Helpers\FunctionHelper::getRepositoryByModule('awss3');
        $awsS3Repo->setDisk($this->disk);
        $filename_array = explode('.', $this->file_name);
        $file_name = $filename_array[0].'_thumbnail'.'.'.$filename_array[1];
        return $awsS3Repo->presignedUrl($file_name);
    }

    public static function resizeImage($imageData, $aspectRatio = [])
    {
        if (!empty($imageData)) {
            // read image from temporary file
            $img = \Intervention\Image\Facades\Image::make($imageData);

            // resize image
            if (!empty($aspectRatio)) {
                $img->resize($aspectRatio[0], null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $img = $img->stream()->__toString();

            return $img;
        } else {
            return '';
        }
    }

    public static function getFileOject($base64, $return = 'base64')
    {
        $image_parts = explode(';base64,', $base64);
        return $return == 'base64' ? $image_parts[1] : base64_decode($image_parts[1]);
    }
}
