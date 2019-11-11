<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    public function document()
    {
        return $this->hasMany(\App\Document::class, 'short', 'type');
    }
}
