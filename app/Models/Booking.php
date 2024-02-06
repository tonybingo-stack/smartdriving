<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $with = ['bookable', 'slot', 'trackDay', 'instructor', 'car'];
    public function bookable()
    {
        return $this->morphTo();
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function trackDay()
    {
        return $this->belongsTo(TrackDay::class);
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
