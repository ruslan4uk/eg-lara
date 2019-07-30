<?php

namespace App\Http\Controllers\ApiV1\Frontend;

use App\Geo\Country;
use App\Geo\City;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index(Request $request, $id) 
    {
        // $request->get('litter') ? $condition = ['name', 'LIKE', $request->get('litter').'%'] : [];

        $country = Country::where('id', $id)->firstOrFail();

        $city = City::where('iso_code', $country->iso_code)
                    ->where('name', '!=', '')
                    ->where('name', 'LIKE', $request->get('litter') . '%')
                    ->select(['id', 'name'])
                    ->orderBy('name', 'ASC')
                    ->paginate(100);

        return response()->json([
            'success' => true,
            'id' => $id,
            'country' => $country,
            'city' => $city
        ], 200);
    }
}
