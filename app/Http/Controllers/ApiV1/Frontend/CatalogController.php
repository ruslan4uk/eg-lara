<?php

namespace App\Http\Controllers\ApiV1\Frontend;

use App\User;
use App\Tour;
use App\Article;
use App\Geo\City;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function tour(Request $request, $country, $city, $category = null) {

        $clauses = ['city_id' => $city, 'active' => 2];

        if($category) {
            $clauses = array_merge($clauses, ['category_id' => $category]);
        }

        // City / Country
        $tour_city = City::with('cityCountry')
            ->select('id', 'name', 'iso_code')
            ->where('name', '!=', '')
            ->where('id', $city)
            ->limit(15)
            ->first();

        $tours = Tour::where($clauses)
                ->with('user')
                ->with('tourTiming')
                ->with('tourPriceType')
                ->with('tourCurrency')
                ->paginate(12);
            
        return response()->json([
            'success' => true,
            'data' => $tours,
            'city_country' => $tour_city
        ]);
    }


    public function guide(Request $request, $country, $city) {
        return response()->json([
            'success' => true,
            'data' => User::with('userCity')
                        ->withCount(['tour' => function($q) {
                            $q->where('active', 2);
                        }])
                        ->where('active', 2)
                        ->whereHas('userCity', function($q) use ($city) {
                            $q->where('city_id', $city);
                        })
                        ->paginate(12)
        ]);
    }

    public function article(Request $request, $country, $city) {
        return response()->json([
            'success' => true,
            'data' => Article::where(['active' => 1, 'city_id' => $city, 'country_id' => $country])
                        ->paginate(12)
        ]);
    }
}
