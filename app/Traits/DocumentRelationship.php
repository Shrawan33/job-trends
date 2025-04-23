<?php

namespace App\Traits;

use App\Models\Document;

trait DocumentRelationship
{
    public function logo()
    {
        return $this->morphMany(Document::class, 'documentable')->where('document_type', 0);
    }

    public function documents()
    { 
        return $this->morphMany(Document::class, 'documentable')->where('document_type', 1);
    }

    public function coverDocuments()
    {
        return $this->morphMany(Document::class, 'documentable')->where('document_type', 5);
    }

    public function images()
    {
        return $this->morphMany(Document::class, 'documentable')->where('document_type', 2);
    }

    public function image()
    {
        return $this->morphOne(Document::class, 'documentable')->where('document_type', 2);
    }

    public function profilePic()
    {
        return $this->morphOne(Document::class, 'documentable')->where('document_type', 0);
    }

    public function videos()
    {
        return $this->morphMany(Document::class, 'documentable')->where('document_type', 3);
    }

    public function video()
    {
        return $this->morphOne(Document::class, 'documentable')->where('document_type', 3);
    }

    public function audios()
    {
        return $this->morphMany(Document::class, 'documentable')->where('document_type', 4);
    }

    public function audio()
    {
        return $this->morphOne(Document::class, 'documentable')->where('document_type', 4);
    }

    public function coverLetter()
    {
        return $this->morphOne(Document::class, 'documentable')->where('document_type', 5);
    }

    public function orderDocuments()
    {
        return $this->morphMany(Document::class, 'documentable')->where('document_type', 6);
    }
}
