<?php
declare(strict_types=1);

namespace App;

use App\Enjoythetrip\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use UserPresenter;

    public static $roles = [];
    protected $fillable = [
        'name', 'email', 'password', 'surname',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    final public function objects():Relations
    {
        return $this->morphedByMany('App\TouristObject', 'likeable');
    }

    final public function larticles():Relations
    {
        return $this->morphedByMany('App\Article', 'likeable');
    }

    final public function articles(): MorphMany
    {
        return $this->morphedByMany('App\Article', 'likeable');
    }

    final public function photos(): MorphMany
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    final public function comments(): HasMany
    {
        return $this->hasMany('App\Comment', 'commentable_type');
    }

    public function reservations():Relations
    {
        return $this->hasMany('App\Reservation');
    }

    final public function HasRole(array $roles)
    {
        foreach ($roles as $role) {
            if (isset(self::$roles[$role])) {
                if (self::$roles[$role]) return true;
            } else {
                self::$roles[$role] = $this->roles()->where('name', $role)->exists();
                if (self::$roles[$role]) return true;
            }
        }
        return false;
    }

    final public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

}
