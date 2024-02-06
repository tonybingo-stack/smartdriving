<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Slot extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $guarded = ['id'];

    public function trackDay()
    {
        return $this->belongsTo(TrackDay::class);
    }

    public function instructors()
    {
        return $this->belongsToMany(User::class, 'instructor_slot', 'slot_id', 'user_id')
                    ->where('role', 'instructor');
    }
}
