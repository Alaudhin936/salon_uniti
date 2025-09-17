<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use App\Models\PaymentMethod;
use App\Models\SalonType;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\VendorDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        $users = User::where('role_id', 2)
            ->join('vendor_details', 'users.id', '=', 'vendor_details.vendor_id')
            ->whereBetween('vendor_details.created_at', [$startOfWeek, $endOfWeek])
            ->select('users.*', 'vendor_details.*')->limit(5)
            ->get();

        $salons = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('users', 'users.id', '=', 'services.vendor_id')->join(
                'vendor_details',
                'vendor_details.vendor_id',
                '=',
                'users.id'
            )
            ->where('appointments.status', 'completed')
            ->select(
                'vendor_details.business_name',
                DB::raw('COUNT(appointments.id) as total_visits'),
                DB::raw('SUM(services.price) as total_revenue')
            )
            ->groupBy('vendor_details.business_name', 'users.name')
            ->orderByDesc('total_visits')
            ->limit(5)
            ->get();

        $topRatedSalons = DB::table('salon_ratings')
            ->join('vendor_details', 'salon_ratings.salon_id', '=', 'vendor_details.id')
            ->select(
                'vendor_details.id as salon_id',
                'vendor_details.location',
                'vendor_details.business_name',
                DB::raw('ROUND(AVG(salon_ratings.rating),1) as avg_rating'),
                DB::raw('COUNT(salon_ratings.id) as total_reviews')
            )
            ->groupBy('vendor_details.id', 'vendor_details.location', 'vendor_details.business_name')
            ->orderByDesc('avg_rating')
            ->orderByDesc('total_reviews')
            ->limit(5)
            ->get();

        $trendingServices = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('vendor_details', 'services.vendor_id', '=', 'vendor_details.id')
            ->select(
                'services.id',
                'services.name',
                'vendor_details.business_name',
                DB::raw('COUNT(appointments.id) as total_bookings')
            )
            ->where('appointments.status', 'booked')
            ->groupBy('services.id', 'services.name', 'vendor_details.business_name')
            ->orderByDesc('total_bookings')
            ->take(5)
            ->get();


        return view('dashboards.default_dashboard', compact('users', 'salons', 'topRatedSalons', 'trendingServices'));
    }

  public function salonIndex()
{
    $types = SalonType::all();
    $salonsCount = DB::table('vendor_details as vd')
        ->join('users as u', 'vd.vendor_id', '=', 'u.id')
        ->where('u.role_id', 2)
        ->count();

    return view('salons', compact('types', 'salonsCount'));
}

    public function salonData(Request $request)
    {
        if ($request->ajax()) {
            // dd('d');
            $salons = DB::table('vendor_details as vd')
                ->join('users as u', 'vd.vendor_id', '=', 'u.id')
                ->join('salon_types as st', 'vd.salon_type_id', '=', 'st.id')
                ->where('u.role_id', 2)
                ->select([
                    'u.id',
                    'vd.vendor_id',
                    'vd.business_name' ,
                    'vd.slogan',
                    'vd.location',
                    'vd.gst_number',
                    'vd.lattitude',
                    'vd.longitude',
                    'vd.created_at',
                    'vd.updated_at',
                    'vd.is_active',
                    'vd.buffer_timing',
                    'vd.cover_photo',
                    'vd.salon_type_id',
                    'st.name as salon_type_name',
                    'u.name as vendor_name',
                    'u.email',
                    'u.phone',
                ]);
            // dd($salons);
            return DataTables::of($salons)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-primary btn-sm viewSalonBtn" data-id="' . $row->id . '">View</button>';
                })
                ->addColumn('status', function ($row) {
                    return (int) $row->is_active;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

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
            'is_active' => (int) $request->is_active,
            'lattitude'     => $request->lattitude,
            'longitude'     => $request->longitude,
        ]);

        return response()->json([
            'status' => 'success',
            'data'  => 'created',
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
                'vendor_details.gst_number',
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

        $settings = AdminSetting::updateOrCreate(
            ['id' => $settings->id ?? null],
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

    public function serviceCatagoryIndex(Request $request)
    {
        $categories = ServiceCategory::all();
        return view('service_categories', compact('categories'));
    }

    public function updateServiceCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = ServiceCategory::findOrFail($id);

        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Service category updated successfully!');
    }

    public function destroyServiceCategory($id)
    {
        $category = ServiceCategory::findOrFail($id);
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service Category deleted successfully.'
        ]);
    }

    public function storeServiceCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:service_categories,name',
        ]);

        $category = new ServiceCategory();
        $category->name = $validated['name'];
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Service category added successfully!',
            'data' => $category
        ]);
    }
}
