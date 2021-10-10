<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    final public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
