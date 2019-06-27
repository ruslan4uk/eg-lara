<?php

namespace App\Http\Controllers\ApiV1\Tour;

use App\Mail\ModerateTour;
use Illuminate\Support\Facades\Mail;

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
    public function index(Request $request)
    {
        $tours = Tour::where('user_id', Auth::id())
                     ->where('active', 2)
                     ->with('tourLanguage')
                     ->with('tourCategory')
                     ->with('tourPeopleCategory')
                     ->with('tourTiming')
                     ->with('tourCurrency')
                     ->with('tourPriceType')
                     ->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $tours
        ]);
    }

    /**
     * Display a moderate tour
     *
     * @return \Illuminate\Http\Response
     */
    public function moderate(Request $request)
    {
        $tours = Tour::where('user_id', Auth::id())
                     ->where('active', 1)
                     ->with('tourLanguage')
                     ->with('tourCategory')
                     ->with('tourPeopleCategory')
                     ->with('tourTiming')
                     ->with('tourCurrency')
                     ->with('tourPriceType')
                     ->paginate(12);

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
        $request->validate([
            'avatar' => 'required',
            'name' => 'required',
            'city_id' => 'required',
            'tour_route' => 'required',
            'category_id' => 'required',
            'people_category_id' => 'required',
            'people_count' => 'required',
            'timing_id' => 'required',
            'price' => 'required',
            'currency_id' => 'required',
            'price_type_id' => 'required',
            'tour_services' => 'required',
            'tour_more' => 'required',
            'tour_other' => 'required',
            'tour_image' => 'required',
            'about' => 'required',
        ]);

        $tour = Tour::where('id', $request->get('id'))
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $tour->update($request->only(['name', 'city_id', 'tour_route', 'category_id', 'people_category_id',
                                    'people_count', 'timing_id', 'price', 'currency_id', 'price_type_id',
                                    'tour_services', 'tour_more', 'tour_other', 'about', 'active' ]));
        
        if(!$tour->active == 2)
            $tour->active = 1;

        $tour->tourLanguage()->sync($request->tour_language);

        $tour->save();

        // Send email
        Mail::to(Auth::user()->email)->send(new ModerateTour(Auth::user()));

        return response()->json([
            'success' => true,
            'message' => 'Тур успешно сохранен!' 
        ]);
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
