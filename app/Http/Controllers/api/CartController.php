<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\interfaces\CartRepositoryInterface;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     private CartRepositoryInterface $CartRepositories;

     public function __construct(CartRepositoryInterface $CartRepositories) {
        $this->CartRepositories = $CartRepositories;
    }

    public function userCarts($id)
    {
        $carts = $this->CartRepositories->userCarts($id);
        return response()->json([
        'carts'=>$carts,
        'length'=>$carts->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request ,$id)
    {
        $cart = $this->CartRepositories->addToCart($request ,$id);

        return response()->json([
            'cart'=>$cart,
            'message'=>'Cart Created Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $cart = $this->CartRepositories->findCart($id);

        return $cart;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id , $bookId)
    {
        $cart = $this->CartRepositories->editCart($request, $id,$bookId);

        return response()->json([
            'cart'=>$cart,
            'message'=>'Cart Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $cart = $this->CartRepositories->deleteCart($id);
        return response()->json([
            'message'=>'Cart Deleted Successfully',

        ]);
    }
}
