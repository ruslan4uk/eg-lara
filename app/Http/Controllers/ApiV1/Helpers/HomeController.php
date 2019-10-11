<?php

namespace App\Http\Controllers\ApiV1\Helpers;

use App\Language;
use App\Category;
use App\ContactType;
use App\Currency;
use App\PeopleCategory;
use App\PriceType;
use App\Service;
use App\Timing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function all() {
        return response()->json([
            'success' => true,
            'data' => [
                'language' => Language::get(),
                'category' => Category::get(),
                'contact_type' => ContactType::get(),
                'currency' => Currency::get(),
                'people_category' => PeopleCategory::get(),
                'price_type' => PriceType::get(),
                'service' => Service::get(),
                'timing' => Timing::get()
            ]
        ]);
    }
}
