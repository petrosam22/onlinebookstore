<?php


namespace App\interfaces;

use App\Models\Book;
use Illuminate\Http\Request;



interface CartRepositoryInterface {

    public function addToCart(Request $request , $id);
    public function editCart(Request $request , $id ,$bookId);
    public function deleteCart( $id );
    public function findCart( $id );
    public function userCarts($id);


}
