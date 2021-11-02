<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Country;
use PDF;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $units = Unit::all();

        return view('units.index', [
            'units' => $units
        ]);
    }

    public function add(Request $request)
    {
        $countries = Country::all();

        return view('units.form', [
            'countries' => $countries
        ]);
    }
    
    public function edit(Request $request, Unit $unit)
    {
        $countries = Country::all();

        return view('units.form', [
            'unit' => $unit,
            'countries' => $countries
        ]);
    }

    public function put(Request $request)
    {
        $unit = new Unit();

        $unit->uid = uniqid();
        $unit->name = $request->name;
        $unit->address = $request->address;
        $unit->postalcode = $request->postalcode;
        $unit->city = $request->city;
        $unit->region = $request->region;
        $unit->country = $request->country;
        $unit->location = $request->location;

        $unit->save();

        return redirect()->route('units.index');
    }

    public function patch(Request $request, Unit $unit)
    {
        $unit->name = $request->name;
        $unit->address = $request->address;
        $unit->postalcode = $request->postalcode;
        $unit->city = $request->city;
        $unit->region = $request->region;
        $unit->country = $request->country;
        $unit->location = $request->location;

        $unit->save();

        return redirect()->route('units.index');
    }

    public function pdf(Request $request, Unit $unit)
    {
        $pdf = PDF::loadView('units.pdf', $unit);

        return $pdf->download($unit->name . '.pdf');
    }
}
