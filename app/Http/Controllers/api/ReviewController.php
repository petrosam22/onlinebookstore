<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\interfaces\ReviewRepositoryInterface;

class ReviewController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    private ReviewRepositoryInterface $ReviewRepositories;

     public function __construct(ReviewRepositoryInterface $ReviewRepositories) {
        $this->ReviewRepositories = $ReviewRepositories;
    }
    public function index()
    {
        $reviews = $this->ReviewRepositories->allReview();

        return $reviews;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function bookReviews(Book $book)
    {
        $bookReviews = $this->ReviewRepositories->bookReviews($book
    );

        return $bookReviews;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        $review = $this->ReviewRepositories->createReview($request);

        return $review;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(ReviewRequest $request,  $id)
    {
        $review =  $this->ReviewRepositories->updateReview($id, $request);

        return $review;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review =  $this->ReviewRepositories->deleteReview($id);
        return $review;


    }
}
