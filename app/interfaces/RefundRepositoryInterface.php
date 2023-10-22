<?php


namespace App\interfaces;

use App\Models\Order;
use App\Models\Refund;
use App\Http\Requests\RefundRequest;


interface RefundRepositoryInterface {
    public function createRefund(Order $order,RefundRequest $request);

    public function updateRefund(Refund $refund, RefundRequest $request);

}
