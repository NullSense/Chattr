<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studies extends Model
{
    protected $table = 'studies';

    public function faculty()
    {
        return $this->belongsTo(\App\Faculty::class, 'id', 'faculty');
    }

    public function curriculum()
    {
        return $this->hasMany(\App\Curriculum::class, 'studies');
    }
}
