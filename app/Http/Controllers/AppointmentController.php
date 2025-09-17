<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Models\VendorDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{

    public function index()
    {
        $currentYear = Carbon::now()->year;
        $today = Carbon::today();
        $vendor = VendorDetail::where('vendor_id', auth()->user()->id)->first();

        $monthlyEarnings = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('users as vendors', 'services.vendor_id', '=', 'vendors.id')
            ->where('vendors.id', auth()->id())
            ->whereYear('appointments.created_at', $currentYear)
            ->where('appointments.status', 'completed')
            ->selectRaw('MONTH(appointments.date) as month, SUM(services.price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $todaysAppointments = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('users as customers', 'appointments.user_id', '=', 'customers.id')
            ->join('users as vendors', 'services.vendor_id', '=', 'vendors.id')
            ->where('vendors.id', auth()->id())
            ->whereDate('appointments.date', $today)
            ->select(
                'appointments.*',
                'services.name as service_name',
                'customers.name as customer_name'
            )
            ->orderBy('appointments.slot_start', 'asc')
            ->get();

        $todaysRevenue = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('users as vendors', 'services.vendor_id', '=', 'vendors.id')
            ->where('vendors.id', auth()->id())
            ->whereDate('appointments.date', $today)
            ->where('appointments.status', 'completed')
            ->sum('services.price');

        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $monthlyRevenue = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('users as vendors', 'services.vendor_id', '=', 'vendors.id')
            ->where('vendors.id', auth()->id())
            ->whereBetween('appointments.date', [$startOfMonth, $endOfMonth])
            ->where('appointments.status', 'completed')
            ->sum('services.price');

        return view('admin_unique_layout.box_dashboard', compact('monthlyRevenue', 'vendor', 'monthlyEarnings', 'todaysAppointments', 'todaysRevenue'));
    }

    public function getAppointments(Request $request)
    {
        $appointmentsQuery = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('users as customers', 'appointments.user_id', '=', 'customers.id')
            ->join('users as vendors', 'services.vendor_id', '=', 'vendors.id')
            ->where('vendors.id', auth()->id())
            ->select(
                'appointments.id',
                'appointments.date',
                'appointments.slot_start',
                'appointments.slot_end',
                'appointments.status',
                'services.name as service_name',
                'customers.name as customer_name'
            );

        // Filter by status
        if ($request->status && $request->status != 'all') {
            if ($request->status == 'upcoming') {
                $appointmentsQuery->whereIn('appointments.status', ['booked', 'pending']);
            } else {
                $appointmentsQuery->where('appointments.status', $request->status);
            }
        }

        return DataTables::of($appointmentsQuery)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $markDoneDisabled = $row->status === 'completed' ? 'disabled' : '';
                $rejectDisabled = $row->status === 'cancelled' ? 'disabled' : '';

                return '
                <div class="d-flex gap-2">
    <i class="fa fa-check-circle text-success ' . $markDoneDisabled . '"
       onclick="markAppointment(' . $row->id . ', \'disable\')"></i>
    <i class="fa fa-times-circle text-danger ' . $rejectDisabled . '"
       onclick="markAppointment(' . $row->id . ', \'enable\')"></i>
</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function appointments(Request $request)
    {
        $users = DB::table('users')->where('role_id', 3)->get();
        $services = DB::table('services')->where('vendor_id', auth()->id())->where('is_active', 1)->get();

        // AJAX request for DataTables
        // Initial page load (view)
        return view('appointments', compact('users', 'services'));
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


        // $bufferTiming = DB::table('services')
        //     ->join('vendor_details', 'services.vendor_id', '=', 'vendor_details.vendor_id')
        //     ->where('services.id', $request->service_id)
        //     ->value('vendor_details.buffer_timing');

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

    public function markAsDone(Request $request, $id, $status)
    {
        // dd($status);
        if ($status == "disable") {
            $appointment = Appointment::where('id', $id)->update([
                'status' => 'completed'
            ]);
            $data = "completed";
        } else if ($status == "enable") {
            $appointment = Appointment::where('id', $id)->update([
                'status' => 'cancelled'
            ]);
            $data = "cancelled";
        }

        if ($appointment) {
            return response()->json(['status' => 200, "data" => $data]);
        }
    }
}
