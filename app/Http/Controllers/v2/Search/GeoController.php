<?php

namespace App\Http\Controllers\v2\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Geo\City;

class GeoController extends Controller
{
    /**
     * Search city
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchCity(Request $request)
    {
        if (!auth()->check()) { return response()->json(['success' => false], 422); }

        $citySearch = City::where(function($q) use ($request) {
                if($request->get('query'))
                    $q->where('name', 'LIKE', $request->get('query').'%');
                if($request->get('sel'))
                    $q->orWhereIn('id', $request->get('sel'));
            })
            ->select('id', 'name', 'locale', 'iso_code', 'city_country', 'region')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $citySearch
        ], 200);
    }
}
