<?php


namespace App\Http\Services;


use App\Http\Contracts\OrderStatusInterface;
use App\Models\OrderStatus;

class OrderStatusService implements OrderStatusInterface
{
    public function __construct(OrderStatus $order_status)
    {
        $this->order_status = $order_status;
    }

    public function index()
    {
        return OrderStatus::all();
    }

    public function show($id)
    {
        return  OrderStatus::find($id);
    }

    public function store($credentials)
    {
        return $this->order_status->create($credentials);
    }

    public function update($credentials,$id)
    {
        return $this->order_status->where('id', $id)->update($credentials);
    }
    
    public function delete($id)
    {
        return $this->order_status->where('id', $id)->delete();
    }
}
?>