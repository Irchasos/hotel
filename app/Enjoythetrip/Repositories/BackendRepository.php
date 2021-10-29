<?php
declare(strict_types=1);

namespace App\Enjoythetrip\Repositories;

use App\City;
use App\Enjoythetrip\Interfaces\BackendRepositoryInterface;
use App\Photo;
use App\Reservation;
use App\TouristObject;
use App\User;


class BackendRepository implements BackendRepositoryInterface
{
    public function getOwnerReservations($request)
    {
        return TouristObject::with([
            'rooms' => function ($q) {
                $q->has('reservations');
            },
            'rooms.reservations.user'])
            ->has('rooms.reservations')
            ->where('user_id', $request->user()->id)
            ->get();
    }

    public function getTouristReservations($request)
    {
        return TouristObject::with([
            'rooms.reservations' => function ($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            },

            'rooms' => function ($q) use ($request) {
                $q->whereHas('reservations', function ($query) use ($request) {
                    $query->where('user_id', $request->user()->id);
                });
            },
            'rooms.reservations.user'
        ])
            ->whereHas('rooms.reservations', function ($q) use ($request) {

                $q->where('user_id', $request->user()->id);
            })
            ->get();
    }

    public function getReservationData($request)
    {
        {
            return Reservation::with('user', 'room')
                ->where('room_id', $request->input('room_id'))
                ->where('day_in', '<=', date('Y-m-d', strtotime($request->input('date'))))
                ->where('day_out', '>=', date('Y-m-d', strtotime($request->input('date'))))
                ->first();
        }


    }

    public function getReservation($id)
    {
        return Reservation::find($id);
    }


    public function deleteReservation(Reservation $reservation)
    {
        return $reservation->delete();
    }


    public function confirmReservation(Reservation $reservation)
    {
        return $reservation->update(['status' => true]);
    }

    public function getCities()
    {
        return City::all();
    }

    public function getCity($id)
    {
        return City::find($id);
    }

    public function createCity($request)
    {
        return City::create([
            'name' => $request->input('name'),
        ]);
    }

    public function updateCity($request, $id)
    {
        return City::where('id', $id)->update([
            'name' => $request->input('name')
        ]);
    }

    public function deleteCity($id)
    {
        return City::where('id', $id)->delete();
    }

    public function saveUser($request)
    {
        $user = User::find($request->user()->id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->save();

        return $user;
    }

    public function getPhoto($id)
    {
        return Photo::find($id);
    }

    public function updateUserPhoto($user, $photo)
    {
        return $user->photos()->save($photo);
    }

    public function createUserPhoto($user, $path)
    {
        $photo = new Photo;
        $photo->path = $path;
        return $user->photos()->save($photo);
    }

    public function deletePhoto(Photo $photo)
    {
        $path = $photo->storagepath;
        $photo->delete();
        return $path;
    }

    public function getObject($id)
    {
        returnTouristObject::find($id);
    }

    public function updateObjectWithAddress($id, $request)
    {
        Address::where('object_id', $id)->update([
            'street' => $request->input('street'),
            'number' => $request->input('number'),
        ]);
        $object = Object::find($id);
        $object->name = $request->input('name');
        $object->city_id = $request->input('city');
        $object->description = $request->input('description');
        $object->save();
        return $object;

    }

    public function createObjectWithAddress( $request)
    {
        $object=new Object;
        $object->user_id = $request->user()->id;
        $object->name = $request->input('name');
        $object->city_id = $request->input('city');
        $object->description = $request->input('description');
        $object->save();
        $object=new Address;
        $address->street=$request->input('street');
        $address->number=$request->input('number');
        $address->object_id=$object->id;
        $address->save();


    }
}
