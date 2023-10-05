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
        $rates = number_format($request->rate, 1); // Format the rate with 1 decimal place

        $rate = Rate::create([
        'user_id' => Auth::user()->id,
        'book_id' => $book->id,
        'rate' => $rates

        ]);

        return $rate;

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

}
