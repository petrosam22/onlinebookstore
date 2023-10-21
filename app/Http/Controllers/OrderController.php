<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\interfaces\OrderRepositoryInterface;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     protected OrderRepositoryInterface  $OrderRepositories;

     public function __construct(OrderRepositoryInterface  $OrderRepositories) {
        $this->OrderRepositories = $OrderRepositories;
     }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $order = $this->OrderRepositories->createOrder($request);

        return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function stripe(Request $request,Order $order)
    {
        $stripe = $this->OrderRepositories->purchase($request,$order);
        return $stripe;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, string $id)
    {
        $order = $this->OrderRepositories->updateOrder($id,$request);

        return $order;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order = $this->OrderRepositories->deleteOrder($order);

        return $order;
    }
    public function closeOrder(){
        $orderClose = $this->OrderRepositories->closeOrder();
        return $orderClose;

    }
}
