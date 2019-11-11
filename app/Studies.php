<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studies extends Model
{
    protected $table = 'studies';

    public function getFaculty()
    {
        return $this->belongsTo(\App\Faculty::class, 'faculty', 'id');
    }

    public function curriculum()
    {
        return $this->hasMany(\App\Curriculum::class, 'studies');
    }
}
