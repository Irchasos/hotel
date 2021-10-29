<?php

namespace App\Http\Controllers;

use App\Enjoythetrip\Gateways\BackendGateway;
use App\Enjoythetrip\Interfaces\BackendRepositoryInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(BackendGateway $backendGateway, BackendRepositoryInterface $backendRepository)
    {
        $this->middleware('CheckAdmin');

        $this->bG = $backendGateway;
        $this->bR = $backendRepository;
    }

    public function index()
    {
        return view('backend.cities.index', ['cities' => $this->bR->getCities()]);
    }


    public function create()
    {
        return view('backend.cities.create');
    }


    public function store(Request $request)
    {
        $this->bG->createCity($request);
        return redirect('backend.cities.index');
    }

    public function edit($id)
    {
        return view('backend.cities.edit', ['city' => $this->bR->getCity($id)]);
    }

    public function update(Request $request, int $id)
    {
        $this->bG->updateCity($request, $id);
        return redirect('/admin/cities');
    }


    public function destroy($id)
    {
        $this->bR->deleteCity($id);
        return redirect('/admin/cities');

    }
}
