<?php
namespace App\interfaces;

use App\Models\Order;
use Illuminate\Http\Request;




interface OrderDeliverRepositoryInterface
 {

    public function createOrderDeliver(Order $order, Request $request);
    public function updateOrderDeliver($id, Request $request);
    public function deleteOrderDeliver($id);
    public function allOrderDelivers();



 }
