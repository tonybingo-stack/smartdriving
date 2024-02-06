<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Car extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    protected $guarded = ['id'];

    public function setWheelPercentagesAttribute($value)
    {
        $default = json_encode([
            'front_left' => 100,
            'front_right' => 100,
            'rear_left' => 100,
            'rear_right' => 100,
        ]);

        $this->attributes['wheel_percentages'] = $value ?: $default;
    }
    public function trackDays()
    {
        return $this->belongsToMany(TrackDay::class, 'car_track_day');
    }
}
