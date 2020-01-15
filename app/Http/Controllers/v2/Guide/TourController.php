<?php

namespace App\Http\Controllers\v2\Guide;

use App\Geo\City;
use App\Helpers\Uploader\ImageUploader;
use App\Http\Controllers\Controller;
use App\Http\Resources\v2\Guide\Tour as TourResource;
use App\Mail\ModerateTour;
use App\Tour;
use App\TourImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::where('user_id', Auth::id())
            ->where('active', '>', 0)
            ->with('tourLanguage')
            ->with('tourCategory')
            ->with('tourPeopleCategory')
            ->with('tourTiming')
            ->with('tourCurrency')
            ->with('tourPriceType')
            ->with('tourCityNew')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tours
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $createTour = Tour::create(['user_id'=> Auth::id()]);

        if($createTour) {
            return response()->json([
                'success' => true,
                'data' => $createTour->id
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
        $showTour = new TourResource(Tour::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail());

        return response()->json([
            'status' => true,
            'data' => $showTour
        ], 200);
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
        $request->validate([
            'avatar' => 'required',
            'name' => 'required',
            'city_id' => 'required',
            'tour_route' => 'required',
            'category_id' => 'required',
//            'people_category_id' => 'required',
            'people_count' => 'required',
            'timing_id' => 'required',
            'price' => 'required',
            'currency_id' => 'required',
            'price_type_id' => 'required',
//            'tour_services' => 'required',
//            'tour_more' => 'required',
//            'tour_other' => 'required',
            'tour_image' => 'required',
            'about' => 'required',
        ]);

        $country_id = City::where('id', $request->get('city_id'))->with('cityCountryNew')->firstOrFail()->toArray();

        $tour = Tour::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $tour->update($request->only(['name', 'city_id', 'tour_route', 'category_id', 'people_category_id',
            'people_count', 'timing_id', 'price', 'currency_id', 'price_type_id',
            'tour_services', 'tour_more', 'tour_other', 'about', 'active' ]));

        if(!$tour->active == 2)
            $tour->active = 1;

        $tour->tourLanguage()->sync($request->tour_language);

        $tour->country_id = $country_id['city_country_new']['id'];

        $tour->save();

        // Send email
        Mail::to(Auth::user()->email)->send(new ModerateTour(Auth::user()));

        return response()->json([
            'success' => true,
            'message' => 'Тур успешно сохранен!'
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
        if(Tour::where(['id' => $id, 'user_id' => Auth::id()])->delete()) {
            return response()->json([
                'success' => true
            ]);
        }
    }

    /**
     * Upload tour avatar
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function uploadAvatar(Request $request, $id)
    {
        if (!Tour::where('user_id', Auth::id())->where('id', $id)->firstOrFail())
            return response()->json(['success' => false], 422);

        $this->validate($request, [
            'userAvatar' => ['required', 'mimes:jpg,jpeg,png,JPG,JPEG,PNG', 'max:10240'],
        ]);

        $avatarPath = (new ImageUploader('users/'. Auth::id() . '/tours/' . $id . '/', $request->file('userAvatar')))->apply('avatar');

        Tour::where('id', $id)->update([
            'avatar' => $avatarPath
        ]);

        return response()->json([
            'success' => true,
            'data' => $avatarPath
        ]);
    }

    /**
     * Upload images from gallery
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function uploadMulti(Request $request, $id)
    {
        if (!Tour::where('user_id', Auth::id())->where('id', $id)->firstOrFail())
            return response()->json(['success' => false], 500);

        $this->validate($request, [
            'file' => ['required', 'mimes:jpg,jpeg,png,JPG,JPEG,PNG', 'max:10240'],
        ]);

        $imageOriginalAndCrop = (new ImageUploader('users/'. Auth::id() . '/tours/' . $id . '/', $request->file('file')))->apply('originalAndCrop');

        $imageOriginalAndCrop = array_merge((array)$imageOriginalAndCrop, ['tour_id' => $id]);

        $image = TourImage::create($imageOriginalAndCrop);

        return response()->json([
            'success' => true,
            'data' => TourImage::findOrFail($image->id),
        ]);
    }

    /**
     * Delete images from gallery
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadMultiDelete(Request $request, $id)
    {
        if (!Tour::where('user_id', Auth::id())->where('id', $id)->firstOrFail())
            return response()->json(['success' => false], 500);

        TourImage::where('id', $request->get('id'))
            ->where('tour_id', $id)
            ->delete();

        return response()->json([
            'success' => true,
            'data' => TourImage::where('tour_id', $id)->get(),
        ]);
    }

}
