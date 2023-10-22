<?php


namespace App\interfaces;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\UpdateOrderRequest;


interface OrderRepositoryInterface {

    public function createOrder(OrderRequest $request);
    public function updateOrder($id,UpdateOrderRequest $request);
    public function purchase(Request $request, Order $order);

    public function deleteOrder(Order $order);
    public function closeOrder(Order $order);
        //softdelete

}
