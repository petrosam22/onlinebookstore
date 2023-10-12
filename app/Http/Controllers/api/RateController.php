<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RateRequest;
use App\Http\Controllers\Controller;
use App\interfaces\RateRepositoryInterface;

class RateController extends Controller
{

    private RateRepositoryInterface $RateRepositories;

    public function __construct(RateRepositoryInterface $RateRepositories) {
        $this->RateRepositories = $RateRepositories;
    }
    public function index(){
        $rates = $this->RateRepositories->rates();
        return response()->json([
            'length'=>$rates->count(),
            'date'=>$rates,
        ]);


    }
    public function store(Book $book, RateRequest $request){
        $rate = $this->RateRepositories->createRate($book,$request);
        if ($rate instanceof JsonResponse) {
            return  $rate;

        }
        return response()->json([
            'date'=>$rate,
            'message'=>'Rate Created Successfully'
        ]);
    }

    public function update($id, RateRequest $request){
        $rate = $this->RateRepositories->updateRate($id,$request);

        return response()->json([
            'date'=>$rate,
            'message'=>'Rate Updated Successfully'
        ]);
    }

    public function destroy($id){
        $rate = $this->RateRepositories->deleteRate($id);

        return response()->json([

            'message'=>'Rate Deleted Successfully'
        ]);
    }

    public function bookRates(Book $book){
        $bookRate = $this->RateRepositories->bookRates($book);

        return  $bookRate;
    }

    public function calculateBookRate(Book $book){
        $calcBookRate = $this->RateRepositories->calculateBookRate($book);

        return  $calcBookRate;

    }
}
