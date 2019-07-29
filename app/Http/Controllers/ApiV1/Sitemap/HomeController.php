<?php

namespace App\Http\Controllers\ApiV1\Sitemap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Tour;

class HomeController extends Controller
{
    public function index() {
        $tours = Tour::select(['id', 'user_id'])
                    ->where('active', 2)
                    ->get();

        $guides = User::where(['role' => null, 'active' => 2])
                    ->select('id')
                    ->get();

        return response()->json([
            'tours' => $tours,
            'guides' => $guides,
            
        ], 200);
    }
}
