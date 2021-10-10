<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enjoythetrip\Gateways\FrontendGateway;
use App\Enjoythetrip\Interfaces\FrontendRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function __construct(FrontendRepositoryInterface $frontendRepository, FrontendGateway $frontendGateway /* Lecture 17 */) /* Lecture 13 FrontendRepositoryInterface */
    {
        $this->middleware('auth')->only(['like', 'unlike', 'addComment', 'makeReservation']);
        $this->fR = $frontendRepository;
        $this->fG = $frontendGateway;
    }

    final public function index(): View
    {
        $objects = $this->fR->getObjectForMainPage();
        return view('frontend.index', ['objects' => $objects]);
    }

    final public function article($id): View
    {
        $article = $this->fR->getArticle($id);
        return view('frontend.article', ['article' => $article]);
    }

    final public function object($id): View
    {
        $object = $this->fR->getObject($id);
        return view('frontend.object', ['object' => $object]);
    }

    final  public function person($id): View
    {
        $user = $this->fR->getPerson($id);
        return view('frontend.person', ['user' => $user]);
    }

    final public function room($id): View
    {
        $room = $this->fR->getRoom($id);
        return view('frontend.room', ['room' => $room]);
    }

    final public function ajaxGetRoomReservations($id)
    {
        $reservations = $this->fR->getReservationsByRoomId($id);
        $dates = [];
        foreach ($reservations as $reservation) {
            $period = CarbonPeriod::create($reservation->day_in, $reservation->day_out);
            foreach ($period as $date) {
                $dates[] = $date->format('m-d-Y');
            }
        }
        $dates = array_values(array_unique($dates));
        return response()->json(
            [
                'reservations' => $dates
            ]
        );
    }

    final  public function roomSearch(Request $request)
    {
        if ($city = $this->fG->getSearchResults($request)) {
            return view('frontend.roomSearch', ['city' => $city]);
        } else {
            if (!$request->ajax()) {
                return redirect('/')->with('norooms', 'No offers we found matching the criteria');
            }
        }
    }

    final  public function searchCities(Request $request)
    {
        $results = $this->fG->searchCities($request);
        return response()->json($results);
    }

    final  public function like($likeable_id, $type, Request $request)
    {
        $this->fR->like($likeable_id, $type, $request);
        return redirect()->back();
    }

    final  public function unlike($likeable_id, $type, Request $request)
    {
        $this->fR->like($likeable_id, $type, $request);
        return redirect()->back();
    }

    final public function addComment($commentable_id, $type, Request $request)
    {
        $this->fG->addComment($commentable_id, $type, $request);
        return redirect()->back();
    }

    public function makeReservation($room_id, $city_id, Request $request)
    {

        $avaiable = $this->fG->checkAvaiableReservations($room_id, $request);

        if(!$avaiable)
        {
            if (!$request->ajax())
            {
                $request->session()->flash('reservationMsg', __('There are no vacancies'));
                return redirect()->route('room',['id'=>$room_id,'#reservation']);
            }

            return response()->json(['reservation'=>false]);
        }
        else
        {
            $reservation = $this->fG->makeReservation($room_id, $city_id, $request);

            if (!$request->ajax())
                return redirect()->route('adminHome');
            else
                return response()->json(['reservation'=>$reservation]);
        }

    }


}

