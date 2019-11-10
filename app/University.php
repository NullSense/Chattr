<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public function faculty()
    {
        return $this->hasMany(\App\Faculty::class, 'university');
    }
}
