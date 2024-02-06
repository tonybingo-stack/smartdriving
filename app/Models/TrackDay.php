<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class TrackDay extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $guarded = ['id'];
    protected $with = ['cars:id', 'track', 'slots'];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_track_day');
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
}
