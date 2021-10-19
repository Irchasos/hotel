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
    public function getReservations($request){
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
        $this->validate($request,[
            'name'=>"required|string|unique:cities",
        ]);

        $this->bR->updateCity($request, $id);
    }


}

