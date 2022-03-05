<?php

namespace App\Http\Services;

use App\Http\Contracts\OrderInterface;
use App\Models\Order;

class OrderService implements OrderInterface
{
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        return Order::with(['status','customer','manager'])->get();
    }

    public function show($id)
    {
        return  Order::find($id);
    }

    public function store($credentials)
    {
        return $this->order->create($credentials);
    }

    public function update($credentials,$id)
    {
        return $this->order->where('id', $id)->update($credentials);
    }
    
    public function delete($id)
    {
        return $this->order->where('id', $id)->delete();
    }
}
?>