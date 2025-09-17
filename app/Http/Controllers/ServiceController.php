<?php

namespace App\Http\Controllers;

use App\Models\SalonType;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\VendorDetail;
use App\Models\VendorScheduleException;
use App\Models\VendorWeeklySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    public function store(Request $request)
    {
        if ($request->hasFile('service_img')) {
            $path = $request->file('service_img')->store('service_img', 'public');
        };

        $id = Service::create([
            'vendor_id' => auth()->user()->id,
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'service_category_id' => $request->service_category_id,
            'service_img' => isset($path) ? $path : ''
        ]);
        return response()->json(['status' => 'success', 'services' => $id]);
    }

    public function index(Request $request)
    {
        $vendor_id = auth()->user()->id;

        $services = Service::where('services.vendor_id', $vendor_id)
            ->join('service_categories', 'services.service_category_id', '=', 'service_categories.id')
            ->select('services.*', 'service_categories.name as category_name')
            ->get();

        $categories = ServiceCategory::all();

        return view('services', compact('services', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        if ($request->hasFile('service_img')) {
            $path = $request->file('service_img')->store('service_img', 'public');
        }

        $service->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'service_category_id' => $request->service_category_id,
            'is_active' => $request->is_active,
            'service_img' => isset($path) ? $path : $service->service_img
        ]);

        return response()->json([
            'status' => true,
            'service' => $service,
        ]);
    }

    public function delete(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json([
            'status' => true,
            'message' => 'Service deleted successfully'
        ]);
    }

    public function editProfile()
    {
        $user = auth()->user();

        $vendor = \App\Models\VendorDetail::where('vendor_id', $user->id)->first();

        $types = SalonType::all();
        return view('vendor_profile', compact('vendor', 'vendor', 'types'));
    }

    public function profileupdate(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'business_name' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'salon_type_id' => 'required',
            'location' => 'nullable|string|max:255',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        $user = User::where('id', auth()->user()->id)->first();
        $vendorDetail = VendorDetail::where('vendor_id', $user->id)->first();

        $coverPhotoPath = null;
        if ($request->hasFile('cover_photo')) {
            if (isset($vendorDetail->cover_photo) && $vendorDetail->cover_photo && Storage::disk('public')->exists($vendorDetail->cover_photo)) {
                Storage::disk('public')->delete($vendorDetail->cover_photo);
            }

            $coverPhotoPath = $request->file('cover_photo')->store('cover_photos', 'public');
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        $vendorUpdateData = [
            'business_name' => $request->business_name,
            'slogan' => $request->slogan,
            'salon_type_id' => $request->salon_type_id,
            'location' => $request->location,
            'gst_number' => $request->gst_number,
            'is_active' => $request->is_active,
        ];

        if ($coverPhotoPath) {
            $vendorUpdateData['cover_photo'] = $coverPhotoPath;
        }

        if (!VendorDetail::where('vendor_id', $user->id)->first()) {
            VendorDetail::updateOrCreate(
                ['vendor_id' => $user->id],
                $vendorUpdateData
            );
        } else {
            VendorDetail::where('vendor_id', $user->id)->first();
        }

        VendorDetail::where('vendor_id', $user->id)->update($vendorUpdateData);

        return response()->json([
            'message' => 'Profile updated successfully!',
            'reload' => $coverPhotoPath ? true : false
        ]);
    }

    public function customerServices(Request $request)
    {
        $vendorId = auth()->id();

        $services = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->where('services.vendor_id', $vendorId)
            ->where('appointments.user_id', $request->customer_id)
            ->select('services.name', 'appointments.date', 'appointments.status')
            ->get();


        return response()->json(['status' => 200, 'data' => $services]);
    }
}
