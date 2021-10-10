<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use Enjoythetrip\Presenters\ArticlePresenter;

    final public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    final  public function comments(): MorphMany
    {
        return $this->morphmany('App\Comment', 'commentable');
    }

    final public function object(): BelongsTo
    {
        return $this->belongsTo(TouristObject::class, 'tourist_object_id');
    }

    final public function isLiked(): bool
    {
        return $this->users()->where('user_id', Auth::user()->id)->exists();
    }

    final public function users(): MorphToMany
    {
        return $this->morphToMany('App\User', 'likeable');
    }
}
