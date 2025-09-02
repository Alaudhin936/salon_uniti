<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function get()
    {
        $trendingServices = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->select(
                'services.id',
                'services.name',
                'services.service_img',
                DB::raw('COUNT(appointments.id) as total_bookings')
            )
            ->groupBy('services.id', 'services.name','services.service_img')
            ->orderByDesc('total_bookings')
            ->take(15)
            ->get();

        return response()->json(['status' => true, 'data' => $trendingServices]);
    }
}
