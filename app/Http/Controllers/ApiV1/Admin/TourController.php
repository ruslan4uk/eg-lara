<?php

namespace App\Http\Controllers\ApiV1\Admin;

use App\Mail\ModerateTourSuccess;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Tour;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::with('user')->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $tours
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tours = Tour::with('user')
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
            'data' => $tours
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Tour::where('id', $id)->update(['active' => $request->get('active')])) 

            $tour = Tour::where('id', $id)->with('user')->first();

            return response()->json([
                'data' => $tour->user()
            ]);

            // Send email
            Mail::to($tour->user()->email)->send(new ModerateTour($tour->user()));
        
            return response()->json([
                'success' => true
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Tour::find($id)->delete()) {
            return response()->json([
                'success' => true
            ]);
        }
    }
}
