<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Rate;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;
use App\interfaces\ReviewRepositoryInterface;

class ReviewRepositories implements ReviewRepositoryInterface{

    public function createReview(ReviewRequest $request){
             $user =  Auth::user()->id;
            $rate = Rate::where('user_id',$user)->where('book_id' , $request->book_id)->pluck('id')->first();
        $review = Review::create([
            'body'=>$request->body,
            'user_id'=>$user,
            'book_id'=>$request->book_id,
            'rate_id'=>$rate
        ]);


        return response()->json([
            'data'=>$review,
            'message'=>'Review Created Successfully'
        ]);

    }


    public function updateReview($id,ReviewRequest $request){
        $review = Review::findOrFail($id);
         if(!$review)
        {
            return response()->json([
                'message'=> 'Review Not Found'
            ]);
        }

        $review->update($request->all());


        return response()->json([
            'data'=>$review,
            'message'=>'Review Updated Successfully'
        ]);




    }

    public function deleteReview($id){
        $review = Review::findOrFail($id);
        if(!$review)
       {
           return response()->json([
               'message'=> 'Review Not Found'
           ]);
       }

       $review->delete();
       return response()->json([
        'message'=>'Review Deleted Successfully'
    ]);




    }
    public function allReview(){
        $reviews = Review::with('rate')->first();

        // $reviews->rate;
        return response()->json([
            'data'=>$reviews,
            'length'=>$reviews->count(),
        ]);

    }

    public function bookReviews(Book $book){
        $bookReviews = $book->reviews()->get();
        return response()->json([
            'data'=>$bookReviews,
            'length'=>$bookReviews->count(),
        ]);



    }


}
