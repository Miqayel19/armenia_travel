<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Customer;
use  App\Models\Manager;
use  App\Models\OrderStatus;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number','customer_id','manager_id','order_status_id',
    ];

    /**
     * Get the status of the order.
     */
    public function status()
    {
        return $this->hasOne(OrderStatus::class);
    }
    
    /**
     * Get the customer that owns the order.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the manager that owns the order.
     */
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
}
