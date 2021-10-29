<?php

namespace App\Policies;

use App\User;
use App\TouristObject;
use Illuminate\Auth\Access\HandlesAuthorization;

class ObjectPolicy
{
    use HandlesAuthorization;


    public function __construct()
    {

    }
    public function checkOwner(User $user, Object $object){
return $user_id ===$object->user_id;
    }
}
