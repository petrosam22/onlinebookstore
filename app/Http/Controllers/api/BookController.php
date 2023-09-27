<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBookRequest;
use App\interfaces\BookRepositoryInterface;

class BookController extends Controller
{
    private BookRepositoryInterface $BookRepositories;

     public function __construct(BookRepositoryInterface $BookRepositories) {
        $this->BookRepositories = $BookRepositories;
    }

    public function index()
    {
        $books = $this->BookRepositories->books();


        foreach ($books as $book) {
            $book->publisher_id = $book->publisher->name;
            $book->author_id = $book->author->name;
            $book->user_id = $book->user ? $book->user->name : null;
            $book->category_id = $book->categories->pluck('name','id');
        }

        return response()->json([
            'data' => $books,
            'length' => $books->count()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $book = $this->BookRepositories->createBook($request);

        return response()->json([
            'data'=>$book,
            'message'=>"Book Created Successfully"
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = $this->BookRepositories->findBook( $id);

        return response()->json([
            'book'=>$book
        ]);
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
    public function update(UpdateBookRequest $request,$id)
    {
        $book = $this->BookRepositories->updateBook($request,$id);

        return response()->json([
            'data'=>$book,
            'message'=> 'Book Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = $this->BookRepositories->deleteBook($id);

        return response()->json([
            'message'=> 'Book Deleted Successfully'
        ]);
    }

    public function addCategory(Request $request, $bookId){
        $book = $this->BookRepositories->addCategoryToBook($request, $bookId);

        return response()->json([
            'book'=>$book
        ]);
    }


    public function bookCategory($id){
        $books = $this->BookRepositories->findBookByCategory($id);

        return response()->json([
            'data'=>$books,
            'length'=>$books->count()
        ]);
    }
}

