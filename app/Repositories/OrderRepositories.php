<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Order;
use App\Jobs\SendOrderEmailJob;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use App\interfaces\OrderRepositoryInterface;
use App\Http\Requests\UpdateOrderRequest;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\StripeClient;

class OrderRepositories implements OrderRepositoryInterface {
    public function createOrder(OrderRequest $request){
        $books = Book::whereIn('id', $request->book_ids)->get();
        $bookIds = $books->pluck('id');
        $bookPrices = $books->pluck('price')->toArray();
        $quantities = $request->quantities;


        $totalPrices = $bookIds->map(function ($bookId, $index) use ($quantities, $bookPrices) {
            $quantity = $quantities[$index];
            $bookPrice = $bookPrices[$index];
            return $quantity * $bookPrice;
        })->sum();

        $user = Auth::user();
        $order = Order::create([
        'user_id'=>$user->id,
        'number'=>$request->number,
        'book_ids'=>json_encode($bookIds),
        'payment'=>'strip',
        'discounts'=>$request->discounts,
        'total_products'=>$books->count(),
        'total'=>$totalPrices,
        'quantities'=>json_encode($quantities)
]);

        $this->attachBooksToOrder($order, $bookIds, $quantities, $bookPrices);

        $this->sendOrderEmail($order, $books, $user);

        return response()->json([
            'data' => $order,
            'totalPrice' => $totalPrices,
            'message' => 'Order Created Successfully',
        ]);

    }

    private function attachBooksToOrder($order, $bookIds, $quantities, $bookPrices)
    {
        // $totalQuantity = array_sum($quantities);
        $total = 0;

        $bookIds->each(function ($bookId, $index) use ($order, $quantities, $bookPrices, &$total) {
            $quantity = $quantities[$index];
            $total += $bookPrices[$index] * $quantity; // Accumulate the total for each book

            // Attach the book with the accumulated quantity and total to the order
            if ($index === count($quantities) - 1) {
                $totalQuantity = array_sum($quantities);

                $order->books()->attach($bookId, ['quantities' => $totalQuantity, 'total' => $total]);
            }
        });
    }


private function sendOrderEmail($order, $books, $user)
{
    dispatch(new SendOrderEmailJob(
        $order->number,
        $books->pluck('name'),
        $order->total,
        $order->books->sum('pivot.quantities'),
        $user->email
    ));
}

public function updateOrder($id,UpdateOrderRequest $request){
    //update order with new data
    $books = Book::whereIn('id', $request->book_ids)->get();
    $bookIds = $books->pluck('id');
    $quantities = $request->quantities;

    $bookPrices = $books->pluck('price')->toArray();
    $totalPrices = $bookIds->map(function ($bookId, $index) use ($quantities, $bookPrices) {
        $quantity = $quantities[$index];
        $bookPrice = $bookPrices[$index];
        return $quantity * $bookPrice;
    })->sum();


    $order = Order::findOrFail($id);
    $order->book_ids = $request->book_ids;
    $order->total_products = $books->count();
    $order->quantities = json_encode($quantities);
    $order->total = $totalPrices;


    $order->save();


    return response()->json([
        'data'=>$order,
        'message'=>"Order Updated Successfully"
    ]);
}


public function purchase(Request $request,Order $order)
{

    

    
    
    $stripe = new StripeClient(env('STRIPE_SECRET'));
    $amountInCents = (int) ($order->total); // Convert to cents and cast to integer

    $paymentIntent = $stripe->paymentIntents->create([
        'amount' => $amountInCents,
        'currency' => 'usd', // Change to your desired currency code
        'payment_method_types' => ['card'],
        'receipt_email' => $order->user->email,
        'confirm' => false, // Set to false to create the PaymentIntent without confirming
        'metadata' => [
            'order_id' => $order->id,
        ],
    ]);
    


    

     



    // Return the client secret to complete the purchase on the client-side
    return response()->json(['client_secret' => $paymentIntent]);
}
}
