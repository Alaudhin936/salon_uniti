<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\PaymentMethod;
use App\Models\Service;
use App\Models\User;
use App\Models\VendorWeeklySchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->input('user_id');
        $serviceId = $request->input('service_id');
        $date = $request->input('date') ?? now()->toDateString();

        $service = Service::findOrFail($serviceId);
        $duration = $service->duration;

        $dayOfWeek = strtolower(Carbon::parse($date)->dayOfWeek);

        $schedule = VendorWeeklySchedule::where('day_of_week', $dayOfWeek)->first();

        if (!$schedule) {
            return view('bookings', [
                'slots'     => [],
                'userId'    => $userId,
                'serviceId' => $serviceId,
                'date'      => $date,
                'message'   => 'No working schedule for this day.'
            ]);
        }

        $startTime = Carbon::parse($schedule->open_time);
        $endTime   = Carbon::parse($schedule->close_time);

        $slots = [];

        while ($startTime->lt($endTime)) {
            $endSlot = (clone $startTime)->addMinutes($duration);

            if ($endSlot->gt($endTime)) {
                break;
            }

            $slotTime = $startTime->format('H:i') . ' - ' . $endSlot->format('H:i');

            $isBooked = Appointment::where('service_id', $serviceId)
                ->whereDate('date', $date)
                ->whereTime('slot_start', $startTime->format('H:i:s'))
                ->exists();

            $slots[] = [
                'time'       => $slotTime,
                'start_time' => $startTime->format('H:i:s'),
                'end_time'   => $endSlot->format('H:i:s'),
                'isBooked'   => $isBooked,
            ];

            $startTime->addMinutes($duration);
        }

        $now = Carbon::now();

        $slots = collect($slots)->map(function ($slot) use ($now, $date) {
            $start = Carbon::parse($date . ' ' . $slot['start_time']);

            if (Carbon::parse($date)->isToday()) {
                // dd($start, $now);
                $slot['isPast'] = $start->lt($now);
            } elseif (Carbon::parse($date)->lt($now->copy()->startOfDay())) {
                $slot['isPast'] = true;
            } else {
                $slot['isPast'] = false;
            }

            return $slot;
        });


        return view('bookings', compact('slots', 'userId', 'serviceId', 'date'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'slot_start' => 'required',
            'slot_end' => 'required|after:slot_start'
        ]);

        $isBooked = Appointment::where('date', $validated['date'])
            ->where(function ($query) use ($validated) {
                $query->where('slot_start', '<', $validated['slot_end'])
                    ->where('slot_end', '>', $validated['slot_start']);
            })
            ->exists();

        if ($isBooked) {
            return response()->json([
                'success' => false,
                'message' => 'This slot has been booked by someone else. Please select another time.'
            ], 409);
        }

        $request->session()->put('pending_booking', [
            'user_id' => $validated['user_id'],
            'service_id' => $validated['service_id'],
            'date' => $validated['date'],
            'slot_start' => $validated['slot_start'],
            'slot_end' => $validated['slot_end'],
            'status' => 'pending_payment'
        ]);

        // $booking = Appointment::create([
        //     'user_id' => $validated['user_id'],
        //     'service_id' => $validated['service_id'],
        //     'date' => $validated['date'],
        //     'slot_start' => $validated['slot_start'],
        //     'slot_end' => $validated['slot_end'],
        //     'status' => 'booked'
        // ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking successful',
            'redirect_url' => route('payments.create')
        ]);
    }

    public function createPayment(Request $request)
    {
        $booking = $request->session()->get('pending_booking');

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking session expired or not found');
        }

        $paymentTypes = PaymentMethod::where('is_active',1)->get();
        $service = Service::find($booking['service_id']);
        $user = User::find($booking['user_id']);

        return view('payment_bookings', compact('booking', 'service', 'user', 'paymentTypes'));
    }

    public function createBooking(Request $request)
    {
        $booking = $request->session()->pull('pending_booking');

        if (!$booking) {
            return redirect()->route('appointments')->with('error', 'Booking session expired');
        }

        $appointment = Appointment::create([
            'user_id' => $booking['user_id'],
            'service_id' => $booking['service_id'],
            'date' => $booking['date'],
            'slot_start' => $booking['slot_start'],
            'slot_end' => $booking['slot_end'],
            'status' => 'booked',
            // 'payment_method' => $validated['payment_method'],
            // 'payment_status' => 'paid'
        ]);

        return response()->json(['status' => 200]);
    }
}
