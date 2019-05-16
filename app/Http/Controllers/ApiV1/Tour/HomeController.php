<?php

namespace App\Http\Controllers\ApiV1\Tour;

use Auth;
use App\Tour;

use App\Http\Resources\Tour as TourResource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::where('user_id', Auth::id())
                     ->with('tourLanguage')
                     ->with('tourCategory')
                     ->with('tourPeopleCategory')
                     ->with('tourTiming')
                     ->with('tourCurrency')
                     ->with('tourPriceType')
                     ->paginate(20);

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
        $new = Tour::create(['user_id'=> Auth::id()]);
        if($new) {
            return response()->json([
                'success' => true,
                'data' => $new
            ], 200);
        }
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
        $tour = new TourResource(Tour::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail());

        return response()->json([
            'status' => true,
            'data' => $tour
        ], 200);
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
        return response()->json([
            'success' => true,
            'data' => $request->all(),
            'id' => $id
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
        //
    }
}
