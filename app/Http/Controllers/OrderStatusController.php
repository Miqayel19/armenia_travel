<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Contracts\OrderStatusInterface;
use App\Models\OrderStatus;
use App\Http\Requests\OrderStatusRequest;

class OrderStatusController extends Controller
{
    protected $orderStatusService;

    public function __construct(OrderStatusInterface $orderStatusService)
    {
        $this->orderStatusService = $orderStatusService;
    } 


    public function index(){
        $order_statuses = $this->orderStatusService->index();
        if(count($order_statuses) > 0){
            return response()->json([
                'data' =>  $order_statuses
            ]);
        } else {
            return response()->json([
                'error' => 'No data found'
            ]);
        }
    }

    public function show($id)
    {
        $order_status =  $this->orderStatusService->show($id);
        if($order_status){
            return response()->json([
                'data' =>  $order_status
            ]);
        }else {
            return response()->json(['error' => 'Order status not found']);
        }
    }

    public function store(OrderStatusRequest $request)
    {
        $credentials = [
            'en' => ['name' => $request->en_name],
            'hy' => ['name' => $request->hy_name],
        ];
        $order_status = $this->orderStatusService->store($credentials);
        if ($order_status) {
            $order_statuses = $this->orderStatusService->index();

            return response()->json(['data' => $order_statuses]);
        } else {
            return response()->json(['error' => 'Order status can not be added']);
        }
    }

    public function edit($id)
    {
        $order_status = $this->orderStatusService->show($id);

        if($order_status){
            return response()->json([
                'data' =>  $order_status
            ]);
        }else {
            return response()->json(['error' => 'Order status not found']);
        }
    }

    public function update(OrderStatusRequest $request,$id)
    {
        $credentials = [
            'en' => ['name' => $request->en_name],
            'hy' => ['name' => $request->hy_name],
        ];
        $order_status =  $this->orderStatusService->update($credentials, $id);
        if ($order_status) {
            $order_statuses =  $this->orderStatusService->index();
            
            return response()->json(['data' => $order_statuses]);
        }
        else {
            return response()->json(['error' => 'Order status can not be updated']);
        }
    }

    public function delete($id)
    {
        $order_status =  $this->orderStatusService->show($id);
        if(!$order_status) {
            return response()->json(['error' => 'Sorry, order status with id ' . $id . ' not found']);
        }
        if ( $this->orderStatusService->delete($id)) {
            $order_statuses = $this->orderStatusService->index();

            return response()->json(['data' => $order_statuses]);
        }
        else {
            return response()->json(['error' => 'Order status can not be deleted']);
        }
    }
}
