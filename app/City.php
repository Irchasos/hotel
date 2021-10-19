<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class City extends Model
{    protected  $guarded=[];
    public  $timestamps = false;

    final public function rooms():HasManyThrough
    {
        return $this->hasManyThrough('App\Room', 'App\TouristObject');
    }
}
