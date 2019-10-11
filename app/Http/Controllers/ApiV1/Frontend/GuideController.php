<?php

namespace App\Http\Controllers\ApiV1\Frontend;

use Auth; 
use App\User;
use App\Tour;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideController extends Controller
{

    /**
     * Return guide
     */
    public function index(Request $request, $id) {

        $clauses = ['id' => $id, 'active' => 2];

        if($request->get('preview') == 1) {
            $clauses = ['id' => Auth::id()];
        }

        return response()->json([
            'success' => true,
            'data' => User::where($clauses)
                        ->with('userContactType')
                        ->with('userLicense')
                        ->with('userService')
                        ->with('userLanguage')
                        ->with('userCity')
                        ->with('userComment')
                        ->with(['tour' => function($query) {
                            $query->where('active', '=', 2);
                            $query->with('tourPriceType');
                            $query->with('tourCurrency');
                            $query->with('tourTiming');
                            $query->limit(9);
                        }])
                        ->firstOrFail()
        ]);
    }


    /**
     * Add comment
     */
    public function addComment(Request $request, $id) {

        $request->validate([
            'text' => 'required'
        ]);

        $user = User::find(Auth::id());

        $user->userComment()
             ->attach(
                Auth::id(), [
                    'page_id' => $id, 
                    'text' => $request->get('text'),
                    'active' => 2,
                ]);

        return response()->json([
            'success' => true,
            'data' => User::with('userComment')->findOrFail($id)
        ]);

    }


    /**
     * Guide one tour
     * @id
     * @tour
     * return json
     */
    public function tour(Request $request, $id, $tour) {
        return response()->json([
            'success' => true,
            'data' => User::where(['id' => $id, 'active' => 2])
                        ->with('userService')
                        ->with('userContactType')
                        ->with(['tour' => function ($query) use ($tour) {
                            $query->where('id', $tour);
                            $query->where('active', '=', 2);
                            $query->with('tourPriceType');
                            $query->with('tourCurrency');
                            $query->with('tourTiming');
                            $query->with('tourImage');
                            $query->with('tourCity');
                            $query->firstOrFail();
                        }])
                        ->firstOrFail()
        ]);
    }

}
