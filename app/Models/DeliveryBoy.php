<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryBoy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'delivery_time',
        'available_at',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('available_at', '<=', now());
    }

    public function assignedOrders()
    {
        return $this->belongsToMany(Order::class, 'assign_order', 'delivery_boy_id', 'order_id')
            ->withPivot('status')
            ->withTimestamps();
    }

}
