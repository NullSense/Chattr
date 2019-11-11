<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    public function studies()
    {
        return $this->belongsTo(\App\Studies::class, 'id', 'studies');
    }

    public function document()
    {
        return $this->hasMany(\App\Document::class, 'id', 'curriculum');
    }
}
