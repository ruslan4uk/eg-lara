<?php

namespace App\Http\Controllers\v2\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Tour;

class SitemapController extends Controller
{
    public function index()
    {
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
