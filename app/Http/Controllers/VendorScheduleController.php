<?php

namespace App\Http\Controllers;

use App\Models\VendorBreak;
use App\Models\VendorScheduleException;
use App\Models\VendorWeeklySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorScheduleController extends Controller
{
    public function timeSlots(Request $request)
    {
        $vendorId = auth()->user()->id;

        $daysOfWeek = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];

        $weeklySchedules = VendorWeeklySchedule::where('vendor_id', $vendorId)
            ->withCount('breaks')
            ->get();

        $exceptions = VendorScheduleException::where('vendor_id', $vendorId)
            ->withCount('breaks')
            ->orderBy('date', 'asc')
            ->get();

        return view('timeslots', compact(
            'daysOfWeek',
            'weeklySchedules',
            'exceptions'
        ));
    }

    public function storeSchedule(Request $request)
    {
        $vendorId = auth()->user()->id;

        $data = $request->validate([
            'day_of_week' => 'required|integer|min:0|max:6',
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'is_closed' => 'nullable|boolean',
        ]);

        $data['vendor_id'] = $vendorId;
        $data['is_closed'] = $request->has('is_closed') ? 1 : 0;

        VendorWeeklySchedule::create($data);

        return response()->json(['status' => 200]);
    }

    public function storeException(Request $request)
    {
        $vendorId = auth()->user()->id;

        $data = $request->validate([
            'date' => 'required|date',
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'is_closed' => 'nullable|boolean',
            'note' => 'nullable|string|max:255',
        ]);

        $data['vendor_id'] = $vendorId;
        $data['is_closed'] = $request->has('is_closed') ? 1 : 0;

        VendorScheduleException::create($data);

        return response()->json(['status' => 200]);
    }

    public function storeBreak(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|integer',
            'type' => 'required|in:weekly,exception',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        VendorBreak::create([
            'vendor_id' => auth()->user()->id,
            'schedule_type' => $request->type,
            'schedule_id' => $request->schedule_id,
            'break_start' => $request->start_time,
            'break_end' => $request->end_time,
        ]);

        return response()->json(['status' => 200]);
    }

    public function editBreak(Request $request, $id)
    {
        $request->validate([
            'start_time' => 'required',
            'end_time'   => 'required|after:start_time',
        ]);

        $break = VendorBreak::findOrFail($id);

        $break->update([
            'break_start' => $request->start_time,
            'break_end'   => $request->end_time,
        ]);

        return response()->json(['status' => 200]);
    }
    public function statusUpdate(Request $request, $id)
    {
        $request->validate([
            'is_closed' => 'required|boolean',
        ]);

        $schedule = VendorWeeklySchedule::findOrFail($id);

        $schedule->is_closed = $request->is_closed;
        $schedule->save();

        return response()->json([
            'status' => 200,
            'message' => 'Schedule status updated successfully',
            'is_closed' => $schedule->is_closed
        ]);
    }

    public function getDaySlots(Request $request)
    {
        $date = $request->input('date');
        $dayIndex = \Carbon\Carbon::parse($date)->dayOfWeek;

        $timeslot = DB::table('vendor_weekly_schedule')
            ->where('day_of_week', $dayIndex)
            ->first();

        return response()->json([
            'start_slot' => $timeslot ? $timeslot->open_time : null,
            'end_slot' => $timeslot ? $timeslot->close_time : null
        ]);
    }
    public function timeUpdate(Request $request, $id)
    {

        $request->validate([
            'field' => 'required|in:open_time,close_time',
            'value' => 'required'
        ]);

        $schedule = VendorWeeklySchedule::findOrFail($id);

        $schedule->{$request->field} = $request->value;
        $schedule->save();

        return response()->json([
            'status' => 200,
            'message' => ucfirst(str_replace('_', ' ', $request->field)) . ' updated successfully',
            'new_value' => $request->value
        ]);
    }
}
