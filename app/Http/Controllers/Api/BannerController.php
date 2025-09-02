<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function get(Request $request) {
        $banners = Banner::all();
        
        return response()->json([
            'status' => true,
            'data' => $banners
        ]);
    }
}
