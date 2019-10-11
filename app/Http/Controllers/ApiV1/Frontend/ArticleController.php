<?php

namespace App\Http\Controllers\ApiV1\Frontend;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index($id) {

        $article = Article::where(['id' => $id, 'active' => 1])->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }
}
