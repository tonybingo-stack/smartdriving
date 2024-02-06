<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function availableSlots($trackDayId) {
        $allSlots = Slot::where('track_day_id', $trackDayId)->get();

        $bookedSlotsIds = Booking::whereHas('slot', function ($query) use ($trackDayId) {
            $query->where('track_day_id', $trackDayId);
        })->pluck('slot_id');

        $availableSlots = $allSlots->whereNotIn('id', $bookedSlotsIds);

        return response()->json($availableSlots);
    }

    public function createBooking(Request $request) {
        $validated = $request->validate([
            'slot_id' => 'required|exists:slots,id',
            'car_id' => 'required|exists:cars,id',
        ]);

        $booking = new Booking();
        $booking->slot_id = $validated['slot_id'];
        $booking->car_id = $validated['car_id'];
        $booking->save();


        return response()->json(['message' => 'Booking created successfully', 'booking' => $booking]);
    }
}
