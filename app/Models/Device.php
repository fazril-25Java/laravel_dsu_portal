<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = "devices";

    protected $fillable = [
        'name',
        'type',
        'description',
        'images',
        'status'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Scope a query to only include active devices.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}