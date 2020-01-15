<?php

namespace App\Http\Controllers\v2\Frontend;

use App\Helpers\Filter\Filter;
use App\Http\Controllers\Controller;
use App\Tour;
use App\User;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    /**
     * @param Request $request
     * @param $country
     * @param $city
     * @return \Illuminate\Http\JsonResponse
     */
    function searchTour(Request $request, $country, $city)
    {
        $clauses = ['active' => 2];

        if ((int)$city) {
            $clauses = array_merge($clauses, ['city_id' => $city]);
        } elseif ((int)$country) {
            $clauses = array_merge($clauses, ['country_id' => $country]);
        }


        $search = (new Filter(Tour::with('user')
            ->with('tourTiming')
            ->where($clauses), $request))->apply()->paginate(27);


        return response()->json([
            'success' => true,
            'data' => $search,
        ], 200);
    }

    public function searchGuide(Request $request, $country, $city)
    {
        $guides = User::where(function ($q) {
                $q->whereNull('role');
                $q->orWhereIn('role', ['guide']);
                $q->where(['active' => 2]);
            })
            ->with('userCity')
            ->with('UserLanguage')
            ->withCount(['tour' => function ($q) {
                $q->where('active', 2);
            }])
//            ->withCount(['userComment' => function ($q) {
//                $q->where('active', 2);
//            }])
            ->withCount('userComment')
            ->whereHas('userCity', function ($q) use ($city) {
                $q->where('city_id', $city);
            })
            ->paginate(27);

        return response()->json([
            'success' => true,
            'data' => $guides
        ], 200);
    }

}
