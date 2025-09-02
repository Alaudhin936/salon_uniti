<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalonController extends Controller
{
    public function get()
    {
        $topSalons = DB::table('vendor_details')
            ->leftJoin('users', 'users.id', '=', 'vendor_details.vendor_id')
            ->leftJoin('services', 'services.vendor_id', '=', 'users.id')
            ->leftJoin('appointments', function ($join) {
                $join->on('appointments.service_id', '=', 'services.id')
                    ->where('appointments.status', '=', 'completed');
            })
            ->leftJoin('salon_ratings', 'salon_ratings.salon_id', '=', 'vendor_details.id')
            ->select(
                'vendor_details.id as salon_id',
                'vendor_details.business_name',
                'vendor_details.cover_photo',
                'vendor_details.lattitude',
                'vendor_details.longitude',
                'vendor_details.location',
                DB::raw('COUNT(DISTINCT appointments.id) as total_visits'),
                DB::raw('SUM(services.price) as total_revenue'),
                DB::raw('ROUND(AVG(salon_ratings.rating),1) as avg_rating'),
                DB::raw('COUNT(salon_ratings.id) as total_reviews')
            )
            ->groupBy(
                'vendor_details.id',
                'vendor_details.business_name',
                'vendor_details.location',
                'vendor_details.cover_photo',
                'vendor_details.lattitude',
                'vendor_details.longitude',
            )
            ->orderByDesc('total_visits')
            ->orderByDesc('avg_rating')
            ->limit(5)
            ->get();

        return response()->json(['status' => true, 'data' => $topSalons]);
    }
}
