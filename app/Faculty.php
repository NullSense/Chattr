<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function getUniversity()
    {
        return $this->belongsTo(\App\University::class, 'id');
    }

    public function getStudies()
    {
        return $this->hasMany(\App\Studies::class, 'faculty');
    }
}
