<?php

namespace App\Http\View\Composers;

use App\Models\Document;
use Illuminate\View\View;

class ImageCropperComposer
{
    private $images = ['id' => [], 'image' => []];
    private $clone = false;

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->clone = $view->clone ?? false;
        if (!empty(old())) {
            $images = old($view->name, $this->images);
        } else {
            try {
                $models = $view->document_type == 0 ? $view->imageModel->logo : $view->imageModel->images;
                foreach ($models as $model) {
                    $this->setImages($model);
                }
            } catch (\Throwable $e) {
            }
            $images = $this->images;

        }
        return $view->with([
            'images' => $images,
            'count' => count($images['image'] ?? [])
        ]);
    }

    private function setImages($model)
    {
        if ($this->clone) {
            $image = Document::resizeImage($model->presigned_url);
            if (!empty($image)) {
                $i = isset($this->images['id']) ? count($this->images['id']) : 0;
                $this->images['id'][$i] = 0;
                $this->images['image'][$i] = 'data:' . $model->mime_type . ';base64,' . base64_encode($image);
            }
        } else {
            $i = isset($this->images['id']) ? count($this->images['id']) : 0;
            $this->images['id'][$i] = $model->id;
            $this->images['image'][$i] = $model->presigned_url;//'data:' . $model->mime_type . ';base64,' . base64_encode($image);
            $this->images['thumbnail_image'][$i] = $model->presignedthumbnail_url;
        }
    }
}
