<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'bookings';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'device_id',
        'user_id',
        'booking_date',
        'return_date',
        'status',
    ];

    /**
     * Define the relationship with the Device model.
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Define the relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
