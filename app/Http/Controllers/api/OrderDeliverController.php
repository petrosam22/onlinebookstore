<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use App\Models\OrderDeliver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\interfaces\OrderDeliverRepositoryInterface;


class OrderDeliverController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     private  OrderDeliverRepositoryInterface $OrderDeliverRepositories;

         public function __construct(OrderDeliverRepositoryInterface $OrderDeliverRepositories) {
            $this->OrderDeliverRepositories = $OrderDeliverRepositories;
        }

    public function index()
    {
        $OrderDeliver = $this->OrderDeliverRepositories->allOrderDelivers();
        return $OrderDeliver;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Order $order, Request $request)
    {
        $OrderDeliver = $this->OrderDeliverRepositories->createOrderDeliver($order,$request);
        return $OrderDeliver;

    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDeliver $orderDeliver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDeliver $orderDeliver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $OrderDeliver = $this->OrderDeliverRepositories->updateOrderDeliver($id,$request);
        return $OrderDeliver;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $OrderDeliver = $this->OrderDeliverRepositories->deleteOrderDeliver($id);
        return $OrderDeliver;

    }
  
}
