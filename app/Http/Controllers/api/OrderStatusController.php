<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\interfaces\OrderStatusRepositoryInterface;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     private OrderStatusRepositoryInterface $OrderStatusRepository;

     public function __construct(OrderStatusRepositoryInterface $OrderStatusRepository) {
        $this->OrderStatusRepository = $OrderStatusRepository;
     }





    public function index()
    {
        $orderStatus = $this->OrderStatusRepository->allOrderStatus();
        return $orderStatus;

    }


    public function changeStatus(Order $order,Request $request){
        $orderStatus = $this->OrderStatusRepository->changeOrderStatus($order,$request);



        return $orderStatus;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function ordersByStatusId($id)
    {
        $orderStatusById = $this->OrderStatusRepository->ordersByStatusId($id);
        return $orderStatusById;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $orderStatus = $this->OrderStatusRepository->createOrderStatus($request);

        return  $orderStatus;
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $orderStatus = $this->OrderStatusRepository->updateOrderStatus($id,$request);

        return  $orderStatus;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderStatus = $this->OrderStatusRepository->deleteOrderStatus($id);

        return  $orderStatus;
    }
}
