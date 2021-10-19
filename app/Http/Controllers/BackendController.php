<?php
declare(strict_types=1);
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Enjoythetrip\Interfaces\BackendRepositoryInterface;
use App\Enjoythetrip\Gateways\BackendGateway;
class BackendController extends Controller
{
    use \App\Enjoythetrip\Traits\Ajax;

    public function __construct(BackendRepositoryInterface $backendRepository, BackendGateway $backendGateway )
    {
        $this->middleware('CheckOwner')->only(['myobjects','confirmReservation','saveobject','saveroom']);
        $this->bR = $backendRepository;
        $this->bG = $backendGateway;
    }
    public function index(Request $request)
    {
        $objects=$this->bG->getReservations($request);
        return view('backend.index',['objects'=>$objects]);
    }


    public function myObjects()
    {
        return view('backend.myobjects');
    }

    public function profile()
    {
        return view('backend.profile');
    }

    public function saveObject()
    {
        return view('backend.saveobject');
    }

    public function saveRoom()
    {
        return view('backend.saveroom');
    }
    public function confirmReservation($id)
    {
        $reservation = $this->bR->getReservation($id);

        $this->authorize('reservation', $reservation);

        $this->bR->confirmReservation($reservation);

        $this->flashMsg ('success', __('Reservation has been confirmed'));


        if (!\Request::ajax())
            return redirect()->back();
    }



    public function deleteReservation($id)
    {
        $reservation = $this->bR->getReservation($id);

        $this->authorize('reservation', $reservation);

        $this->bR->deleteReservation($reservation);

        $this->flashMsg ('success', __('Reservation has been deleted'));

        if (!\Request::ajax())
            return redirect()->back();
    }

}
