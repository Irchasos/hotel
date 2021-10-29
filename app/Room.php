<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Room extends Model
{
    final public function photos(): MorphMany
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    final public function object(): BelongsTo
    {
        return $this->belongsTo('App\TouristObject', 'tourist_object_id');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
