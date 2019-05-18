<?php

namespace App\Http\Controllers\ApiV1\Frontend;

use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    public function index($id) {
        return response()->json([
            'success' => true,
            'data' => User::where('id', $id)
                            ->firstOrFail()
        ]);
    }
}
