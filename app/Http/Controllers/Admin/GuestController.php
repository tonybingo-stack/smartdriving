<?php

namespace App\Http\Controllers\Admin;
use App\Models\Guest;

class GuestController extends TemplateController
{
    public function __construct(Guest $guest)
    {
        parent::__construct($guest, 'Admin/Guest/IndexGuests', 'email');
    }
}
