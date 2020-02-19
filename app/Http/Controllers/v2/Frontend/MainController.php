<?php

namespace App\Http\Controllers\v2\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\MailSend;
use App\Mail\Callback;
use App\Tour;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $lastTour = Tour::orderBy('created_at', 'desc')
            ->where('active', 2)
            ->with(['user' => function($q) {
                $q->select('id', 'name', 'avatar');
            }])
            ->with('tourLanguage')
            ->with('tourCategory')
            ->with('tourPeopleCategory')
            ->with('tourTiming')
            ->with('tourCurrency')
            ->with('tourPriceType')
            ->with('tourCityNew')
            ->limit(6)
            ->groupBy('user_id')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'last_tour' => $lastTour,
            ]
        ], 200);
    }

    public function sendCallback(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'comment' => ['required'],
        ]);

        MailSend::dispatch(['email' => 'info@excursguide.ru'], (new Callback($request->all())))->onConnection('database');

        return response()->json([
            'success' => true
        ]);
    }
}
