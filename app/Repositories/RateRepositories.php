<?php


namespace App\Repositories;

use App\Models\Book;
use App\Models\Rate;
use App\Http\Requests\RateRequest;
use Illuminate\Support\Facades\Auth;
use App\interfaces\RateRepositoryInterface;


class RateRepositories implements RateRepositoryInterface
{
    public function createRate(Book $book, RateRequest $request)
    {

     $user= Auth::user()->id;
    $existingRate = $book->rates()->where('user_id', $user)->first();
    // dd( $existingRate);

    $rate = number_format($request->rate, 1); // Format the rate with 1 decimal place


    if( $existingRate ){


        return response()->json([

         'error'=>'You Cannot Create Anther Rate In The Same Book'
        ]);

    }

    if($rate > 5.0){

        return response()->json([

            'error'=>'Rate cannot exceed 5'
           ]);

    }


    $newRate = new Rate();
    $newRate->user_id = $user;
    $newRate->book_id = $book->id;
    $newRate->rate = $rate;
    $newRate->save();
    return $newRate;



    }

    public function updateRate($id, RateRequest $request)
    {

        $rateBook = Rate::findOrFail($id);
        $rateBook->rate = $request->rate;

        $rateBook->save();

        return  $rateBook;



    }

    public function deleteRate($id)
    {

        $rate = Rate::findOrFail($id);
        $rate->delete();


        return $rate;


    }

    public function rates()
    {
        $rates = Rate::all();
        return $rates;


    }


    public function bookRates(Book $book){

        return $rateBook=  $book->rates;
    }


    public function calculateBookRate(Book $book){
        $rate = $book->rates()->pluck('rate')->toArray();

        $rateNumber =count($rate); //length number
        $rateSum = array_sum($rate) / $rateNumber; //array sum


        return response()->json([
            'data'=>$rateSum,
        ]);
    }

}
