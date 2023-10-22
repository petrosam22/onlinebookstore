<?php
namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\OrderDeliver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use App\Notifications\OrderDelivered;
use Illuminate\Support\Facades\Notification;

use Illuminate\Notifications\AnonymousNotifiable;
use App\interfaces\OrderDeliverRepositoryInterface;



class OrderDeliverRepositories implements OrderDeliverRepositoryInterface {


    public function createOrderDeliver(Order $order, Request $request){

        $existingDeliver = OrderDeliver::where('order_id',$order->id)->first();
        if($existingDeliver){
            return response()->json([

                'message'=>'Order has already been delivered'
            ]);
        }

        $OrderDeliver = OrderDeliver::create([
            'order_id'=>$order->id,
            'delivered_at'=>Date::now()
        ]);



        // $orderStatus = OrderStatus::where('status','delivered')->first();

        // $order->order_status_id = $orderStatus->id;
        // $order->save();



        $user = $order->user;
        // Notification::send($user, new OrderDelivered($order));


        return response()->json([
            'data'=>$OrderDeliver,
            'message'=>'Order Delivered Successfully'
        ]);



    }


    public function updateOrderDeliver($id, Request $request){
        $orderDeliver = OrderDeliver::findOrFail($id);
        $orderDeliver->update($request->all());

        return response()->json([
            'data'=> $orderDeliver,
            'message'=>'Order Deliver Updated Successfully'
        ]);



    }


    public function deleteOrderDeliver($id){
        $orderDeliver = OrderDeliver::findOrFail($id);


        $orderDeliver->delete();

        return response()->json([
            'message'=>'orderDeliver Deleted Successfully'
        ]);

    }


    public function allOrderDelivers(){
        $orderDeliver = OrderDeliver::paginate(5);
        return response()->json([
            'data'=> $orderDeliver,
            'length'=>$orderDeliver->count()
        ]);

    }



}
