<?php

namespace App\Http\Controllers\ApiV1\Geo;

use App\Geo\Country;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index() {
        return response()->json([
            'success' => true,
            'data' => Country::select('id', 'name', 'iso_code')->get()
        ]);
    }
}
