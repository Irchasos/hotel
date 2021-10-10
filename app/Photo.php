<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Photo extends Model
{
    final public function photoable():MorphTo
    {
        return $this->morphTo();

    }
}
