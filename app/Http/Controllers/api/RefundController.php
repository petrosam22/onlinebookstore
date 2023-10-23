<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use App\Models\Refund;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RefundRequest;
use App\interfaces\RefundRepositoryInterface;

class RefundController extends Controller
{

    private RefundRepositoryInterface $RefundRepositories;

     public function __construct(RefundRepositoryInterface $RefundRepositories) {
        $this->RefundRepositories = $RefundRepositories;
    }


    public function index(){}
    public function store(RefundRequest $request,Order $order){
        $refund = $this->RefundRepositories->createRefund($order,$request);

        return $refund;
    }

    public function update(Refund $refund, RefundRequest $request){
        $updateRefund = $this->RefundRepositories->updateRefund($refund,$request);

        return $updateRefund;

    }

    public function orderThatRefund(){
        $orderRefund = $this->RefundRepositories->orderRefunded();

        return $orderRefund;


    }

}
