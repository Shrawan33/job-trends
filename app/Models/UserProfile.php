<?php

namespace App\Models;

use App\Helpers\FunctionHelper;
use App\Traits\CreatedByUpdatedBy;
use App\Traits\DocumentRelationship;
use App\Traits\ModelState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedBy;
    use ModelState;
    use DocumentRelationship;

    public $table = 'users_profile';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];
    protected $appends = ['user_address'];

    public $fillable = [
        'user_id',
        'position',
        'company_profile',
        'address',
        'company_email',
        'company_phone',
        'company_website',
        'video_link',
        'location',
        'state_id',
        'location_id',
        'country_id',
        'qec'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'position' => 'string',
        'company_profile' => 'string',
        'address' => 'string',
        'company_email' => 'string',
        'company_phone' => 'integer',
        'company_website' => 'string',
        'video_link' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'location' => 'string',
        'qec' => 'nullable|numeric|max:63'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        // 'position' => 'required',
        'company_email' => 'nullable|email',
        'company_website' => 'nullable|url',
        'video_link' => 'nullable',
        'location' => 'nullable'

    ];
    public static $messages = [
        'company_website.url' => 'Please enter valid website address. Exa: https://www.google.com',
        // 'video_link.url' => 'Please enter valid video link. Exa: https://www.youtube.com/watch?v=7AuZ1cebqGU',
        // 'qec.max' => 'Please enter a value less than or equal to 63.',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function documents()
    // {
    //     return $this->hasMany(Document::class, 'documentable_id', 'user_id')->where('document_type', 1)->where('documentable_type', '\App\models\UserProfile');
    // }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function getImages($modalicon = true, $pdf = false, $count = null, $width = '', $height = '')
    {
        $documentRepo = FunctionHelper::getRepositoryByModule('documents');
        $documentRepo->setDisk('user');

        if ($this->documents->count() > 0) {
            $prefix = '<div class="col-xs-4">';
            $suffix = '</div>';
            $i = 1;

            foreach ($this->documents as $image) {
                if (!empty($count) && $i > $count) {
                    break;
                }
                // $src = $endpoint . $image->file_path;
                $src = $image->presigned_url;

                $imageTag = '<img src="' . $src . '" class="modal-images" width="' . $width . '" height="' . $height . '">';
                $divForImage[] = $prefix . $imageTag . $suffix;
                $i++;
                // $file_path = $endpoint . $image->file_path;
            }
            $content = '<div class="row">' . implode('', $divForImage) . '</div>';
            $product_image_id = "div-images-{$this->id}";
            if ($modalicon) {
                $content = "<a href='javascript:void(0)' class='ico-product-images' onmouseover='contentModal(\"$this->title Images\", \"$product_image_id\")' ><i class='glyphicon glyphicon-picture'></i></a><div class='hide' id='$product_image_id'>$content</div>";
            }
            return $content;
        }
        return null;
    }

    public function getUserAddressAttribute()
    {
        $address = [
            'district' => $this->district->title ?? null,
            'state' => $this->state->title ?? null,
            'country' => $this->country->name ?? null,
        ];
        //dd(implode(', ', array_filter($address)));
        return implode(', ', array_filter($address));
    }
}
