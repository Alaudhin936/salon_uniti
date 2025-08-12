<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function store(Request $request)
    {

        $id = Service::create([
            'vendor_id' => auth()->user()->id,
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration
        ]);

        return response()->json(['status' => 'success', 'services' => $id]);
    }

    public function index(Request $request)
    {
        $vendor_id = auth()->user()->id;
        $services = Service::where('vendor_id', $vendor_id)->get();

        return view('services', compact('services'));
    }


    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $service->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration
        ]);

        return response()->json([
            'status' => true,
            'service' => $service
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
}
