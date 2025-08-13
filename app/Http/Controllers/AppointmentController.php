<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{

    public function index()
    {
        $appointments = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('users as customers', 'appointments.user_id', '=', 'customers.id')
            ->join('users as vendors', 'services.vendor_id', '=', 'vendors.id')
            ->where('vendors.id', auth()->id())
            ->select(
                'appointments.*',
                'services.name as service_name',
                'customers.name as customer_name'
            )
            ->orderBy('appointments.date', 'asc')
            ->get()
            ->groupBy('date');

        return view('admin_unique_layout.box_dashboard', compact('appointments'));
    }

    public function appointments()
    {

        $users = DB::table('users')->where('role_id', 3)->get();
        $services = DB::table('services')->where('vendor_id', auth()->id())->get();
        $appointments = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('users as customers', 'appointments.user_id', '=', 'customers.id')
            ->join('users as vendors', 'services.vendor_id', '=', 'vendors.id')
            ->where('vendors.id', auth()->id())
            ->select(
                'appointments.*',
                'services.name as service_name',
                'customers.name as customer_name'
            )
            ->orderBy('appointments.date', 'asc')
            ->get()
            ->groupBy('date');

        return view('appointments', compact('appointments', 'users', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'slot_start' => 'required',
            'slot_end' => 'required',
        ]);

        $exists = DB::table('appointments')
            ->where('service_id', $request->service_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->whereBetween('slot_start', [$request->slot_start, $request->slot_end])
                        ->orWhereBetween('slot_end', [$request->slot_start, $request->slot_end]);
                })
                    ->orWhere(function ($q) use ($request) {
                        $q->where('slot_start', '<=', $request->slot_start)
                            ->where('slot_end', '>=', $request->slot_end);
                    });
            })
            ->exists();

        if ($exists) {
            return response()->json([
                'status'  => 'error',
                'message' => 'This slot is already booked for the selected service.'
            ], 409);
        }

        $id = DB::table('appointments')->insertGetId([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'date' => $request->date,
            'slot_start' => $request->slot_start,
            'slot_end' => $request->slot_end,
            'status' => 'booked',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $appointment = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('users as customers', 'appointments.user_id', '=', 'customers.id')
            ->select(
                'appointments.*',
                'services.name as service_name',
                'customers.name as customer_name'
            )
            ->where('appointments.id', $id)
            ->first();

        return response()->json([
            'status' => 'success',
            'data' => $appointment
        ]);
    }

    public function customers(Request $request)
    {
        $allCustomers = DB::table('appointments as app')
            ->join('services as ser', 'ser.id', '=', 'app.service_id')
            ->join('users as u', 'u.id', '=', 'app.user_id')
            ->where('ser.vendor_id', auth()->id())
            ->groupBy('u.id', 'u.name', 'u.email', 'u.phone')
            ->select('u.id', 'u.name', 'u.email', 'u.phone')
            ->get();


        return view('customers', compact('allCustomers'));
    }

    public function markAsDone(Request $request, $id, $status) {
        
        $appointment = Appointment::where('id',$id)->update([
            'status' => 'completed'
        ]);

        if($appointment){
            return response()->json(['status' => 200]);
        }

    }
}
