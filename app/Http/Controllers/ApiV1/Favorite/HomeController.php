<?php

namespace App\Http\Controllers\ApiV1\Favorite;

use Auth;
use App\User;
use App\FavoriteGuide;
use App\FavoriteTour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * User favorite guide
     *
     * @return void
     */
    public function favoriteGuide() 
    {
        if(Auth::check()) {
            $favoriteGuide = User::where('id', Auth::id())
                    ->with('userFavoriteGuide')
                    ->withCount(['tour' => function($q) {
                        $q->where('active', 2);
                    }])
                    ->first();     
        } else {
            $favoriteGuide = array();
        }

        return response()->json([
            'success' => true,
            'data' => $favoriteGuide,
        ]);
    }

    /**
     * Delete favorite guide
     */
    public function deleteFavoriteGuide(Request $request) 
    {
        if(Auth::check()) {
            if(FavoriteGuide::where('user_id', Auth::id())->where('guide_id', $request->get('id'))->delete()) {
                return response()->json([
                    'success' => true
                ]);
            }
        }
    }

    /**
     * Add favorite guide
     */
    public function addFavoriteGuide(Request $request)
    {
        if(Auth::check()) {
            if(FavoriteGuide::where(['user_id' => Auth::id(), 'guide_id' => $request->get('id')])->first()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Уже в вашем списке'
                ], 200);
            }
            if(FavoriteGuide::firstOrCreate(['user_id' => Auth::id(), 'guide_id' => $request->get('id')])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Успешно добавлено в избранное'
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка'
            ], 422);
        }        
    }

    /**
     * User favorite guide
     *
     * @return void
     */
    public function favoriteTour() 
    {
        if(Auth::check()) {
            $favoriteTour = User::where('id', Auth::id())
                    ->with('userFavoriteTour')
                    ->first();     
        } else {
            $favoriteTour = array();
        }

        return response()->json([
            'success' => true,
            'data' => $favoriteTour,
        ]);
    }

    /**
     * Delete favorite guide
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

    /**
     * Add favorite guide
     */
    public function addFavoriteTour(Request $request)
    {
        if(Auth::check()) {
            if(FavoriteTour::where(['user_id' => Auth::id(), 'tour_id' => $request->get('id')])->first()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Уже в вашем списке'
                ], 200);
            }
            if(FavoriteTour::firstOrCreate(['user_id' => Auth::id(), 'tour_id' => $request->get('id')])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Успешно добавлено в избранное'
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка'
            ], 422);
        }        
    }
}
