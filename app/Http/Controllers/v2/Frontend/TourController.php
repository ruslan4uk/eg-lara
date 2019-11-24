<?php

namespace App\Http\Controllers\v2\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function getUserExcursion(Request $request, $id)
    {
        $tour = \App\Tour::where([
            'id' => $id,
            'active' => 2
            ])
            ->with('tourLanguage')
            ->with('tourCategory')
            ->with('tourPeopleCategory')
            ->with('tourTiming')
            ->with('tourCurrency')
            ->with('tourPriceType')
            ->with('tourCityNew')
            ->with('tourImage')
            ->firstOrFail();

        $user = \App\User::where('id', $tour->user_id)
            ->with(['userCity' => function($q) {
                $q->with('cityCountry');
            }])
            ->with('userLanguage')
            ->with('userService')
            ->with('userContact')
            ->where('active', 2)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $tour,
            'user' => $user
        ], 200);
    }
}
