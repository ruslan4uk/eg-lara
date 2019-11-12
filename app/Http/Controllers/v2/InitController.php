<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InitController extends Controller
{
    /**
     * Init data for api v2
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function init() {
        return response()->json([
            'success' => true,
            'data' => [
                'language' => \App\Language::select('id','name')->get(),
                'category' => \App\Category::select('id','name')->get(),
                'contact_type' => \App\ContactType::get(),
                'currency' => \App\Currency::get(),
                'people_category' => \App\PeopleCategory::get(),
                'price_type' => \App\PriceType::get(),
                'service' => \App\Service::select('id','name')->get(),
                'timing' => \App\Timing::get()
            ]
        ]);
    }
}
