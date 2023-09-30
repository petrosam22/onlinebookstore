<?php

namespace App\Repositories;

use App\Models\Book;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\interfaces\CartRepositoryInterface;


class CartRepositories implements CartRepositoryInterface{
    public function addToCart(Request $request , $id){
        $bookId = Book::findOrFail($id)->id;
        $cart = Cart::create([
            'user_id'=> Auth::user()->id,
            'quantity'=>$request->quantity

        ]);

        $cart->books()->attach($bookId,['quantity'=>$request->quantity
    ]);


        return $cart;

    }


    public function editCart(Request $request , $id ,  $bookId){

        $cart = Cart::findOrFail($id);
        $book = Book::findOrFail($bookId);

        $cart->quantity = $request->quantity;
        $cart->save();
        $bookCart = DB::table('book_cart')->where('cart_id',$cart->id)->delete();
// if(){

// }
        $cart->books()->attach($book->id, ['quantity' => $request->quantity]);

        return $cart;


    }
    public function deleteCart($id){
    $cartId = Cart::findOrFail($id);

    $cartId->books()->detach();
    $cartId->delete();

    return $cartId;


    }

    public function userCarts($id){
        $carts = Cart::where('user_id' , Auth::user()->id)->pluck('id');

        $book_carts = DB::table('book_cart')
        ->whereIn('cart_id', $carts)
        ->join('books', 'books.id', '=', 'book_cart.book_id')
        ->select('book_cart.id', 'books.name', 'book_cart.cart_id', 'book_cart.quantity')
        ->get();

        return $book_carts;
    }


    public function findCart( $id ){
        $cart = Cart::where('id', $id)
        ->where('user_id', Auth::user()->id)
        ->first();

    if (!$cart) {
        // Cart not found, return an appropriate response or handle the error
        return response()->json(['error' => 'Cart not found'], 404);
    }

    $book_carts = DB::table('book_cart')
        ->where('cart_id', $cart->id)
        ->join('books', 'books.id', '=', 'book_cart.book_id')
        ->select('book_cart.id', 'books.name', 'book_cart.cart_id', 'book_cart.quantity')
        ->get();

    return $book_carts;

    }


}
