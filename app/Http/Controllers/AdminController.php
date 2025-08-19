<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use App\Models\PaymentMethod;
use App\Models\SalonType;
use App\Models\User;
use App\Models\VendorDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $salons = DB::table('vendor_details as vd')
            ->join('users as u', 'vd.vendor_id', '=', 'u.id')
            ->join('salon_types as st', 'vd.salon_type_id', '=', 'st.id')
            ->where('u.role_id', 2)
            ->select([
                'u.id',
                'vd.vendor_id',
                'vd.business_name',
                'vd.slogan',
                'vd.location',
                'vd.gst_number',
                'vd.lattitude',
                'vd.longitude',
                'vd.created_at',
                'vd.updated_at',
                'vd.shop_open',
                'vd.shop_close',
                'vd.is_active',
                'vd.buffer_timing',
                'vd.cover_photo',
                'vd.salon_type_id',
                'st.name as salon_type_name',
                'u.name as vendor_name',
                'u.email',
                'u.phone',
                'u.otp',
                'u.role_id',
                'u.email_verified_at',
                'u.password',
                'u.remember_token'
            ])
            ->get();

        $types = SalonType::all();

        return view('salons', compact('salons', 'types'));
    }

    public function registerSalon(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|string|max:20',
            'business_name' => 'required|string|max:255',
            'slogan'        => 'nullable|string|max:255',
            'salon_type_id'          => 'required',
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
            'salon_type_id' => $request->salon_type_id,
            'location'      => $request->location,
            'gst_number'    => $request->gst_number,
            'shop_open'     => $request->shop_open,
            'shop_close'    => $request->shop_close,
            'lattitude'     => $request->lattitude,
            'longitude'     => $request->longitude,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Salon registered successfully'
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
                'vendor_details.location',
                'vendor_details.gst_number',
                'vendor_details.shop_open',
                'vendor_details.shop_close',
                'salon_types.name',
                'vendor_details.cover_photo'
            )->join('salon_types', 'vendor_details.salon_type_id', '=', 'salon_types.id')
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

    public function settings()
    {
        $settings = AdminSetting::first();
        return view('settings', compact('settings'));
    }

    public function storeSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'favicon' => 'nullable|image|mimes:png,jpg,jpeg,ico|max:1024',
            'privacy_policy' => 'nullable',
            'terms_conditions' => 'nullable',
        ]);

        $settings = AdminSetting::first();

        if ($request->hasFile('site_logo')) {
            if ($settings && $settings->site_logo && Storage::exists('public/' . $settings->site_logo)) {
                Storage::delete('public/' . $settings->site_logo);
            }
            $validated['site_logo'] = $request->file('site_logo')->store('logos', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($settings && $settings->favicon && Storage::exists('public/' . $settings->favicon)) {
                Storage::delete('public/' . $settings->favicon);
            }
            $validated['favicon'] = $request->file('favicon')->store('favicons', 'public');
        }

        // Use updateOrCreate → if row exists update, else insert new
        $settings = AdminSetting::updateOrCreate(
            ['id' => $settings->id ?? null], // match by ID if exists
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Settings saved successfully!',
            'data' => $settings
        ]);
    }

    public function salonTypes()
    {
        $salonTypes = SalonType::all();
        return view('salon_types', compact('salonTypes'));
    }

    public function updateSalonType(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $salonType = SalonType::findOrFail($id);
        $salonType->update($validated);

        return response()->json(['success' => true, 'data' => $salonType]);
    }

    public function storeSalonType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $salonType = SalonType::create($validated);

        return response()->json(['success' => true, 'data' => $salonType]);
    }

    public function destroySalonType($id)
    {
        $salonType = SalonType::findOrFail($id);
        $salonType->delete();

        return response()->json(['success' => true]);
    }

    public function paymentIndex()
    {
        $paymentTypes = PaymentMethod::all();
        return view('payments', compact('paymentTypes'));
    }


    public function storePaymentType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $salonType = PaymentMethod::create($validated);

        return response()->json(['status' => 200]);
    }

    public function updatePaymentType(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $salonType = PaymentMethod::findOrFail($id);

        $salonType->update($validated);
        if ($request->is_active) {
            $salonType->update([
                'is_active' => 1
            ]);
        } else {
            $salonType->update([
                'is_active' => 0
            ]);
        }
        return response()->json(['status' => 200]);
    }


    public function destroyPaymentType(Request $request, $id)
    {
        $paymentType = PaymentMethod::findOrFail($id);
        $paymentType->delete();

        return response()->json(['status' => 200]);
    }
}
