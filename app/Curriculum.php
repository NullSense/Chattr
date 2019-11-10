<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    public function studies()
    {
        return $this->belongsTo(\App\Studies::class, 'id', 'studies');
    }
}
