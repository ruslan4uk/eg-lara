<?php

namespace App\Http\Controllers\v2\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function getUserExcursion(Request $request, $user_id, $tour_id)
    {
        $tour = \App\Tour::where([
            'id' => $tour_id,
            'user_id' => $user_id,
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

        return response()->json([
            'success' => true,
            'data' => $tour
        ], 200);
    }
}
