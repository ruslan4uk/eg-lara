<?php

namespace App\Http\Controllers\v2\Admin\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Language;

class HomeController extends Controller
{
    /**
     * Get all language
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Language::get(),
        ], 200);
    }

    /**
     * CreateOrUpdate Language
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create($id, Request $request)
    {
        $new_language = Language::updateOrCreate(['id' => $request->get('id')], [
            'name' => $request->get('name'),
            'iso_code' => $request->get('iso_code'),
            'active' => 1
        ]);

        return response()->json([
            'success' => true,
            'data' => $new_language,
            'response' => $request->all()
        ], 200);
    }

    /**
     * Delete language
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        Language::destroy($id);

        return response()->json([
            'success' => true,
        ], 200);
    }
}
