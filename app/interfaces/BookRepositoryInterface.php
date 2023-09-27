<?php

namespace App\interfaces;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Requests\UpdateBookRequest;



interface BookRepositoryInterface {
    public function books();
    public function createBook(BookRequest $request);
    public function updateBook(UpdateBookRequest $request , $id);
    public function deleteBook($id);
    public function findBook($id);
    public function addCategoryToBook(Request $request, $bookId);
    public function findBookByCategory($id);
}
