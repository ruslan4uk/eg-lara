<?php

namespace App\Http\Controllers\v2\Search;

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
//            ->with('cityCountryNew')
            ->limit(10)
            ->get();

        $citySearchResource = SearchResource::collection($citySearch);

        return response()->json([
            'success' => true,
            'data' => $citySearchResource
        ], 200);
    }
}
