<?php

namespace App\Http\Controllers\v2\Admin\Geo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Geo\Country;

class CountryController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Country::orderBy('name', 'asc')->where('name', '!=', '')->get()
        ], 200);
    }
}
