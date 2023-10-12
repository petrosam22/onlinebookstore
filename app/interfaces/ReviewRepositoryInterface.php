<?php

namespace App\interfaces;

use App\Models\Book;
use App\Http\Requests\ReviewRequest;

interface ReviewRepositoryInterface{
    public function createReview(ReviewRequest $request);
    public function updateReview($id,ReviewRequest $request);
    public function deleteReview($id);
    public function allReview();
    public function bookReviews(Book $book);



}
