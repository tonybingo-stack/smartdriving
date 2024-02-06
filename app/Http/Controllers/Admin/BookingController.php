<?php

namespace App\Http\Controllers\Admin;
use App\Models\Booking;


class BookingController extends TemplateController
{
    public function __construct(Booking $booking)
    {
        parent::__construct($booking, 'Admin/Booking/IndexBookings', '');
    }
}
