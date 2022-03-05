<?php

namespace App\Http\Controllers;

use App\Http\Contracts\OrderInterface;
use App\Models\OrderStatus;
use App\Models\Customer;
use App\Models\Manager;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderInterface $orderService)
    {
        $this->orderService = $orderService;
    } 

    public function index()
    {
        $orders =  $this->orderService->index();

        if(count($orders) > 0){
            return response()->json([
                'data' =>  $orders
            ]);
        } else {
            return response()->json([
                'error' => 'No data found'
            ]);
        }
    }

    public function create()
    {
        $orderStatuses = OrderStatus::all();
        $customers = Customer::all();
        $managers = Manager::all();
        
        return response()->json([
            'data' =>  $orderStatuses,
            'customers' =>  $customers,
            'managers' =>  $managers,
        ]);
    }

    public function show($id)
    {
        $order =  $this->orderService->show($id);
        if($order) {
            return response()->json([
                'data' =>  $order,
            ]);
        }else {
            return response()->json(['error' => 'Order not found']);
        }
        
    }
    public function store(OrderRequest $request)
    {
        $credentials = [
            'customer_id' => $request->customer_id,
            'number' => $request->number,
            'manager_id' => $request->manager_id,
            'order_status_id' => $request->order_status_id,
        ];
        $order = $this->orderService->store($credentials);
        if ($order) {
            $orders = $this->orderService->index();

            return response()->json(['data' => $orders]);
        } else {
            return response()->json(['error' => 'Order can not be added']);
        }
    }

    public function edit($id)
    {
        $order =  Order::where('id',$id)->with(['status','customer','manager'])->get();
        if($order){
            $orderStatus = $order->status;
            $customers = $order->customer;
            $managers = $order->manager;
            
            return response()->json([
                'data' =>  $order,
                'customers' =>  $customers,
                'managers' =>  $managers,
                'orderStatus' =>  $orderStatus,
            ]);
        }  else {
            return response()->json(['error' => 'Order not found']);
        }  
        
    }

    public function update(OrderRequest $request,$id)
    {
        $credentials = [
            'customer_id' => $request->customer_id,
            'number' => $request->number,
            'manager_id' => $request->manager_id,
            'order_status_id' => $request->order_status_id,
        ];
        $order =  $this->orderService->update($credentials, $id);
        if ($order) {
            $orders =  $this->orderService->index();
            
            return response()->json(['data' => $orders]);
        }
        else {
            return response()->json(['error' => 'Order can not be updated']);
        }
    }

    public function delete($id)
    {
        $order =  $this->orderService->show($id);
        if(!$order) {
            return response()->json(['error' => 'Sorry, order with id ' . $id . ' not found']);
        }
        if ( $this->orderService->delete($id)) {
            $orders = $this->orderService->index();

            return response()->json(['data' => $order]);
        }
        else {
            return response()->json(['error' => 'Order can not be deleted']);
        }
    }
}
