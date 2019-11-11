<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    public function type()
    {
        return $this->belongsTo(\App\DocumentType::class, 'type', 'short');
    }

    public function curriculum()
    {
        return $this->belongsTo(\App\Curriculum::class, 'curriculum');
    }
}
