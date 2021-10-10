<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    final public function address(): BelongsTo
    {
        return $this->belongsTo('App\TouristObject');
    }
}
