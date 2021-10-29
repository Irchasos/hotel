<?php
declare(strict_types=1);

namespace App\Enjoythetrip\Gateways;

use App\Enjoythetrip\Interfaces\BackendRepositoryInterface;

class BackendGateway
{
    use \Illuminate\Foundation\Validation\ValidatesRequests;

    public function __construct(BackendRepositoryInterface $bR)
    {
        $this->bR = $bR;
    }

    public function getReservations($request)
    {
        if ($request->user()->hasRole(['owner', 'admin'])) {

            $objects = $this->bR->getOwnerReservations($request);
        } else {
            $objects = $this->bR->getTouristReservations($request);

        }
        return $objects;
    }

    public function createCity($request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:cities'
        ]);
        $this->bR->createCity($request);
    }

    public function updateCity($request, $id)
    {
        $this->validate($request, [
            'name' => "required|string|unique:cities",
        ]);

        $this->bR->updateCity($request, $id);
    }

    public function saveUser($request)
    {
        $this->validate($request, [
            'name' => "required|string",
            'surname' => "required|string",
            'email' => "required|email",
        ]);

        if ($request->hasFile('userPicture')) {
            $this->validate($request, [
                'userPicture' => 'mimes:jpeg,jpg,png,gif|required|max:1000'


            ]);
        }

        return $this->bR->saveUser($request);
    }

    public function saveObject($id, $request)
    {
        $this->validate($request, [
            'city' => 'required|string',
            'name' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|integer',
            'description' => 'required|string|min:100',
        ]);
        if ($id) {$object= $this->bR->updateObjectWithAddress($id,$request);}
        else {$object=$this->bR->createObjectWithAddress($request);}

if ($request->hasFile('objectPictures')) {
$this->validate($request, \App\Photo::imageRules($request,'objecPictures'));
}
return $object;
}



}
