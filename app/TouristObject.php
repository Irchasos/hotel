<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

class TouristObject extends Model
{
    use Enjoythetrip\Presenters\ObjectPresenter;

    final public function city(): BelongsTo
    {
        return $this->belongsTo('App\City');
    }

    final public function photos(): MorphMany
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    final public function scopeOrdered($query)
    {
        return $query->orderBy('name', 'asc');
    }

    final public function address(): HasOne
    {
        return $this->hasOne('App\Address');
    }

    final public function rooms(): HasMany
    {
        return $this->hasMany('App\Room');
    }

    final public function comments(): MorphMany
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    final public function articles(): HasMany
    {
        return $this->hasMany('App\Article', 'tourist_object_id');
    }

    final public function isLiked(): bool
    {
        return $this->users()->where('user_id', Auth::user()->id)->exists();
    }

    final public function users(): MorphToMany
    {
        return $this->morphToMany('App\User', 'likeable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
