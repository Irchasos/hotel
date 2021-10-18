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
        $this->bR = $backendRepository;
        $this->bG = $backendGateway;
    }
    public function index(Request $request)
    {
        $objects=$this->bG->getReservations($request);
        return view('backend.index',['objects'=>$objects]);
    }

    public function cities()
    {
        return view('backend.cities');
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
    public function confirmResLink($id)
    {
$reservation=$this->bR->getReservation($id);   }
    public function deleteResLink()
    {
        return redirect()->back;
    }
}
