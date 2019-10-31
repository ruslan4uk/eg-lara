<?php

namespace App\Http\Controllers\v2\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Mail\ModerateTourSuccess;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Tour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Get Tours
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTour()
    {
        return response()->json([
            'success' => true,
            'data' => Tour::where('active', '>', '0')
                ->orderBy('created_at', 'desc')
                ->paginate(15)
        ],200);
    }

    /**
     * Get full tour
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTourProfile($id)
    {
        // Delete blank tour
        DB::table('tours')
            ->whereNull('active')
            ->where('created_at', '<', Carbon::now()->subDays(2))
            ->delete();

        $tour = Tour::with('user')
            ->with('tourLanguage')
            ->with('tourCategory')
            ->with('tourPeopleCategory')
            ->with('tourTiming')
            ->with('tourCurrency')
            ->with('tourPriceType')
            ->with('tourImage')
            ->with(['tourCity' => function($q) {
                $q->with('cityCountry');
            }])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $tour
        ]);
    }

    /**
     * Change tour status
     *
     * @param $id
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function changeTourActiveStatus ($id, Request $request)
    {
        if(!in_array($request->get('active'), [1,2]))
            return false;

        Tour::where('id', $id)->update(['active' => $request->get('active')]);

        // Send email
        if($request->get('active') == 2) {
            $tour = Tour::where('id', $id)->with('user')->firstOrFail();
            Mail::to($tour->user->email)->send(new ModerateTourSuccess($tour->user));
        }

        return response()->json([
            'success' => true,
        ], 200);
    }
}
