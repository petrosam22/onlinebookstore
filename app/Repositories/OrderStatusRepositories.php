<?php
namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\interfaces\OrderStatusRepositoryInterface;




class OrderStatusRepositories  implements  OrderStatusRepositoryInterface{

    public function allOrderStatus(){
        $orderStatus = OrderStatus::paginate(5);
        return response()->json([
            'data'=> $orderStatus,
            'length'=>$orderStatus->count()
        ]);


    }


    public function createOrderStatus(Request $request)
    {

        $orderStatus = OrderStatus::create([
            'status'=>$request->status,

        ]);

        return response()->json([
            'data'=> $orderStatus,
            'message'=>'orderStatus Created Successfully'
        ]);

    }


    public function updateOrderStatus($id,Request $request)
    {
        $orderStatus = OrderStatus::findOrFail($id);
        if(!$orderStatus){
            return 'orderStatus Not Found';
        }

        $orderStatus->status = $request->status;
        $orderStatus->save();
        return response()->json([
            'data'=> $orderStatus,
            'message'=>'orderStatus Updated Successfully'
        ]);


    }

    public function deleteOrderStatus($id)
    {
        $orderStatus = OrderStatus::findOrFail($id);
        if(!$orderStatus){
            return 'orderStatus Not Found';
        }
        $orderStatus->delete();

        return response()->json([
            'message'=>'orderStatus Deleted Successfully'
        ]);

    }



    public function changeOrderStatus(Order $order,Request $request){
        if(!$order){
            return response()->json([
                 'error'=>'Order Not Found'
            ]);
        }
        $order->order_status_id = $request->order_status_id;
        $order->save();

        return response()->json([
            'data'=>$order,
            'message'=>'orderStatus Changed Successfully'
        ]);


    }


    public function ordersByStatusId($id){
        $order = Order::where('order_status_id' ,$id)->get();

        return response()->json([
            'data'=>$order,
            'length'=>$order->count()
        ]);
        }
}
