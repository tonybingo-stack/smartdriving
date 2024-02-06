<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use App\Traits\Bookable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, Bookable;
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_type',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRole::class,
    ];

    public function isAdmin()
    {
        return $this->role === UserRole::Admin; // Adjust the condition based on your user roles setup
    }

    public function isInstructor()
    {
        return $this->role === UserRole::Instructor; // Adjust the condition based on your user roles setup
    }

    public function isMechanic()
    {
        return $this->role === UserRole::Mechanic; // Adjust the condition based on your user roles setup
    }

    public function isReseller()
    {
        return $this->role === UserRole::Reseller; // Adjust the condition based on your user roles setup
    }

    public function isRegularUser()
    {
        return $this->role === UserRole::User; // Adjust the condition based on your user roles setup
    }


    public function instructorBookings()
    {
        return $this->hasMany(Booking::class, 'instructor_id');
    }

    public function availableSlots()
    {
        return $this->belongsToMany(Slot::class, 'instructor_slot')->withTimestamps();
    }
}
