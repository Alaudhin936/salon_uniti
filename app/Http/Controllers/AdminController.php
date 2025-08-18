<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VendorDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $salons = DB::table('vendor_details')
            ->join('users', 'vendor_details.vendor_id', '=', 'users.id')
            ->where('users.role_id', 2)
            ->get();

        return view('salons', compact('salons'));
    }

    public function registerSalon(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|string|max:20',
            'business_name' => 'required|string|max:255',
            'slogan'        => 'nullable|string|max:255',
            'type'          => 'required|string|max:50',
            'location'      => 'required|string|max:255',
            'gst_number'    => 'nullable|string|max:50',
            'lattitude'     => 'nullable|numeric',
            'longitude'     => 'nullable|numeric',
            'password'   => 'required|string|min:6',
            'shop_open'  => 'required',
            'shop_close' => 'required'
        ]);

        $vendor = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role_id'  => 2,
        ]);

        $vendorDetails = VendorDetail::create([
            'vendor_id'     => $vendor->id,
            'business_name' => $request->business_name,
            'slogan'        => $request->slogan,
            'type'          => $request->type,
            'location'      => $request->location,
            'gst_number'    => $request->gst_number,
            'shop_open'     => $request->shop_open,
            'shop_close'    => $request->shop_close,
            'lattitude'     => $request->lattitude,
            'longitude'     => $request->longitude,
        ]);

        $data = [
            'name'          => $vendor->name,
            'email'         => $vendor->email,
            'phone'         => $vendor->phone,
            'business_name' => $vendorDetails->business_name,
            'slogan'        => $vendorDetails->slogan,
            'type'          => $vendorDetails->type,
            'location'      => $vendorDetails->location,
            'shop_open'     => $vendorDetails->shop_open,
            'shop_close'    => $vendorDetails->shop_close,
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Salon registered successfully',
            'data' => $data
        ]);
    }

    public function showVendorDetails($id)
    {
        $vendor = User::join('vendor_details', 'users.id', '=', 'vendor_details.vendor_id')
            ->where('users.id', $id)
            ->select(
                'users.name as vendor_name',
                'users.email',
                'users.phone',
                'vendor_details.business_name',
                'vendor_details.type',
                'vendor_details.location',
                'vendor_details.gst_number',
                'vendor_details.shop_open',
                'vendor_details.shop_close',
                'vendor_details.cover_photo'
            )
            ->first();

        $totalRevenue = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->where('services.vendor_id', $id)
            ->where('appointments.status', 'completed')
            ->sum('services.price');

       $vendor['total_revenue'] = $totalRevenue;

        if (!$vendor) {
            return response()->json([
                'status' => 404,
                'message' => 'Vendor not found'
            ], 404);
        }

        return response()->json($vendor);
    }
}
