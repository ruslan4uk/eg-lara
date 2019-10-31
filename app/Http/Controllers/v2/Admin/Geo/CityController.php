<?php

namespace App\Http\Controllers\v2\Admin\Geo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Geo\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($iso)
    {
        return response()->json([
            'success' => true,
            'data' => City::where('iso_code', $iso)
                ->where('name', '!=', '')
                ->orderBy('name', 'asc')
                ->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($iso, Request $request)
    {
        $new_city = City::updateOrCreate(['id' => $request->get('id')], [
            'iso_code' => $iso,
            'name' => $request->get('name')
        ]);

        return response()->json([
            'success' => true,
            'data' => $new_city
        ], 200);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::destroy($id);

        return response()->json([
            'success' => true,
        ], 200);
    }
}
