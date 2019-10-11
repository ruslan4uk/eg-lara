<?php

namespace App\Http\Controllers\ApiV1\Geo;

use App\Geo\City;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index (Request $request) {
        
        return response()->json([
            'success' => true,
            'data' => City::with('cityCountry')
                            ->select('id', 'name', 'iso_code')
                            ->where('name', '!=', '')
                            ->where('name', 'LIKE', $request->get('q').'%')
                            ->limit(15)
                            ->get()
        ]);
        
    }

    public function id (Request $request) {
        return response()->json([
            'success' => true,
            'data' => City::with('cityCountry')
                            ->select('id', 'name', 'iso_code')
                            ->where('name', '!=', '')
                            ->where('id', $request->get('id'))
                            ->limit(15)
                            ->first()
        ]);
    }

}
