<?php


namespace App\Repositories;

use App\Models\Book;
use App\Models\Order;
use App\Models\Refund;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RefundRequest;
use App\interfaces\RefundRepositoryInterface;


class RefundRepositories implements RefundRepositoryInterface {


    public function createRefund(Order $order,RefundRequest $request){

            $bookOrder = DB::table('book_orders')
            ->where('book_id', $request->book_id)
            ->where('order_id', $order->id)
            ->first();
            $quantity=$request->quantity;
            $BookPrice =  Book::where('id',$request->book_id)->first();
        // Create the refund record
            $refund = Refund::create([
                'user_id' => $order->user->id,
                'order_id' => $order->id,
                'book_id' => $request->book_id,
                'book_order_id' => $bookOrder->id,
                'amount' => $BookPrice->price * $quantity,
                'refund_number' =>1,
                'quantity' => $quantity,
                'status' => 'pending',
            ]);
          $bookOrderQuantity = $bookOrder->quantities;

          $updatedQuantity = $bookOrderQuantity - $quantity;

            DB::table('book_orders')
                ->where('id', $bookOrder->id)
                ->update(['quantities' => $updatedQuantity]);
                $bookOrders = DB::table('book_orders')
                ->where('order_id', $order->id)
                ->get();


            $quantities = [];
            $total = 0;
            foreach ($bookOrders as $bookOrder) {
                $book = Book::find($bookOrder->book_id);
                $bookPrice = $book->price;
                $bookQuantity = $bookOrder->quantities;
                $quantities[] = $bookQuantity;
                $total += $bookPrice * $bookQuantity;
            }

            $order->quantities = json_encode($quantities);
            $order->total = $total;
            $order->is_refund = true;
            $order->save();

            return response()->json([
                'data' => $refund,
                'message' => 'Refund created successfully',
            ]);




    }



    public function updateRefund(Refund $refund, RefundRequest $request)
{
    $bookOrder = DB::table('book_orders')
        ->where('book_id', $refund->book_id)
        ->where('order_id', $refund->order_id)
        ->first();

    if (!$bookOrder) {
        return response()->json([
            'message' => 'Book order not found',
        ], 404);
    }

    $quantity = $request->quantity;
    $bookPrice = Book::where('id', $refund->book_id)->value('price');

    $bookOrderQuantity = $bookOrder->quantities;  //1
    $updatedQuantity = $bookOrderQuantity + $refund->quantity;   //1+1 =2
    $TotalQuantity  =$updatedQuantity - $quantity; //2-2

        $refund->amount = $bookPrice * $quantity;
        $refund->quantity = $quantity;
        $refund->status = 'pending';

    $refund->save();
    DB::table('book_orders')
        ->where('id', $bookOrder->id)
        ->update(['quantities' => $TotalQuantity]);

    $order = Order::find($refund->order_id);
    $bookOrders = DB::table('book_orders')
        ->where('order_id', $order->id)
        ->get();

    $quantities = [];
    $total = 0;

    foreach ($bookOrders as $bookOrder) {
        $book = Book::find($bookOrder->book_id);
        $bookPrice = $book->price;
        $bookQuantity = $bookOrder->quantities;
        $quantities[] = $bookQuantity;
        $total += $bookPrice * $bookQuantity;
    }

    $order->quantities = json_encode($quantities);
    $order->total = $total;
    $order->save();

    return response()->json([
        'data' => $refund,
        'message' => 'Refund updated successfully',
    ]);
}


public function orderRefunded(){

    $orders = Order::where('is_refund',true)->get();
    return $orders;

}
}
