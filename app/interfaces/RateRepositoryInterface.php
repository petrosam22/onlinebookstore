<?php


namespace App\interfaces;

use App\Models\Book;
use App\Models\Rate;
use App\Http\Requests\RateRequest;


interface RateRepositoryInterface{

    public function createRate(Book $book, RateRequest $request);
    public function updateRate($id,RateRequest $request);
    public function deleteRate($id);
    public function Rates();
    public function bookRates(Book $book);

}
