<?php
declare(strict_types=1);

namespace App\Http\Controllers;
use App\Enjoythetrip\Gateways\BackendGateway;
use App\Enjoythetrip\Interfaces\BackendRepositoryInterface;
use App\Enjoythetrip\Traits\Ajax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BackendController extends Controller
{
    use Ajax;

    public function __construct(BackendRepositoryInterface $backendRepository, BackendGateway $backendGateway)
    {
        $this->middleware('CheckOwner')->only(['myobjects', 'confirmReservation', 'saveobject', 'saveroom']);
        $this->bR = $backendRepository;
        $this->bG = $backendGateway;
    }

    final public function index(Request $request)
    {
        $objects = $this->bG->getReservations($request);
        return view('backend.index', ['objects' => $objects]);
    }


    final public function myObjects()
    {
        return view('backend.myobjects');
    }

    public function profile(Request $request)
    {

        if ($request->isMethod('post')) {

            $user = $this->bG->saveUser($request);

            if ($request->hasFile('userPicture')) {
                $path = $request->File('userPicture')->store('users', 'public');
                if (count($user->photos) != 0) {
                    $photo = $this->bR->getPhoto($user->photos->first()->id);

                    Storage::disk('public')->delete($photo->storagepath);
                    $photo->path = $path;

                    $this->bR->updateUserPhoto($user, $photo);

                } else {
                    $this->bR->createUserPhoto($user, $path);
                }

            }


            return redirect()->back();
        }

        return view('backend.profile', ['user' => Auth::user()]);
    }

    final public function saveObject()
    {
        return view('backend.saveobject');
    }

    final public function saveRoom()
    {
        return view('backend.saveroom');
    }

    final public function confirmReservation($id)
    {
        $reservation = $this->bR->getReservation($id);

        $this->authorize('reservation', $reservation);

        $this->bR->confirmReservation($reservation);

        $this->flashMsg('success', __('Reservation has been confirmed'));


        if (!\Request::ajax()) {
            return redirect()->back();
        }
    }


    final public function deleteReservation($id)
    {
        $reservation = $this->bR->getReservation($id);

        $this->authorize('reservation', $reservation);

        $this->bR->deleteReservation($reservation);

        $this->flashMsg('success', __('Reservation has been deleted'));

        if (!\Request::ajax()) {
            return redirect()->back();
        }
    }

    final public function deletePhoto($id)
    {
        $photo = $this->bR->getPhoto($id);
        $this->authorize('checkOwner', $photo);
        $path = $this->bR->deletePhoto($photo);
        Storage::disk('public')->delete($path);

        return redirect()->back();
    }
}
