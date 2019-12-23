<?php

namespace App\Http\Controllers\v2\Search;

use App\Geo\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\Search as SearchResource;
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
        $citySearch = City::where(function($q) use ($request) {
                if($request->get('query'))
                    $q->where('name', 'LIKE', $request->get('query').'%');
                if($request->get('sel'))
                    $q->orWhereIn('id', (array)$request->get('sel'));
            })
            ->where('name', '!=', '')
            ->limit(10)
            ->get();

        $citySearchResource = SearchResource::collection($citySearch);

        return response()->json([
            'success' => true,
            'data' => $citySearchResource
        ], 200);
    }

    public function cityList ($country_id, Request $request)
    {
//        $cityList = Country::where('id', $country_id)
//            ->with(['coutryCity' => function ($q) {
//                $q->where('name', '!=', '');
//                $q->select('name', 'iso_code');
//            }])
//            ->paginate(40);

        $cityList = City::whereHas('cityCountryNew', function($q) use ($country_id) {
                $q->where('id', $country_id);
            })
            ->where('name', '!=', '')
            ->select('id', 'name', 'iso_code', 'city_country', 'region')
            ->orderBy('name')
            ->paginate(240);

        if(count($cityList) < 1) return response()->json(['success' => false], 422);

        return response()->json([
            'success' => true,
            'data' => $cityList
        ], 200);
    }
}
