<?php

namespace App\Http\Controllers\v2\Frontend;

use Auth;
use App\FavoriteTour;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function getFavoriteList(Request $request)
    {
        $favorite_tour = \App\Tour::whereHas('tourFavorite', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->get();

        return response()->json([
            'success' => true,
            'data' => $favorite_tour
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addFavoriteTour(Request $request)
    {
        if(Auth::check()) {
            if(FavoriteTour::where(['user_id' => Auth::id(), 'tour_id' => $request->get('id')])->first()) {
                return response()->json([
                    'success' => true,
                ], 200);
            }
            if(FavoriteTour::firstOrCreate(['user_id' => Auth::id(), 'tour_id' => $request->get('id')])) {
                return response()->json([
                    'success' => true,
                ], 200);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFavoriteTour(Request $request)
    {
        if(Auth::check()) {
            if(FavoriteTour::where('user_id', Auth::id())->where('tour_id', $request->get('id'))->delete()) {
                return response()->json([
                    'success' => true
                ]);
            }
        }
    }
}
