<?php

namespace App\interfaces;

use App\Models\Order;
use Illuminate\Http\Request;


interface OrderStatusRepositoryInterface{
public function createOrderStatus(Request $request);
public function updateOrderStatus($id,Request $request);
public function deleteOrderStatus($id);
public function allOrderStatus();
public function changeOrderStatus(Order $order,Request $request);

public function ordersByStatusId($id);


}

