<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use Enjoythetrip\Presenters\CommentPresenter;

    public $timestamps = false;

    final public function commmentable(): MorphTo
    {
        return $this->morphTo();
    }

    final public function user()
    {
        return $this->belongsTo('App\User');
    }

    final public function photos()
    {
        return $this->morphmany('App\Photo', 'photoable');
    }
}
