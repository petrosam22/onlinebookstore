<?php
namespace App\Repositories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ValidatesImageTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateBookRequest;
use App\interfaces\BookRepositoryInterface;

class BookRepositories implements BookRepositoryInterface {
    use ValidatesImageTrait;


    public function books(){
        $books = Book::all();


        return $books;
    }
    public function createBook(BookRequest $request)
    {
        $image = $this->validateImage($request->image,'book');

        // $category = Category::value('id');

                $book = Book::create([
            'image'=>$image,
            'name'=> $request->name,
            'author_id'=> $request->author_id,
            'user_id'=>Auth::user()->id,
            'publisher_id'=> $request->publisher_id ,
            'description'=>  $request->description,
            'quantity'=> $request->quantity,
            'price'=>$request->price ,
            'category_id'=>$request->category_id
        ]);
        $categoryId = $request->input('category_id'); // Assuming you send the new category ID(s) in the 'categoryIds' field of the request

        // Attach the new category ID(s) to the book
        $book->categories()->attach($categoryId);


        return $book;

    }


    public function updateBook(UpdateBookRequest $request,$id){
        $book = Book::findOrFail($id);

        $book->update($request->all());


        return $book;
    }

    public function deleteBook($id){
        $book = Book::findOrFail($id);

        $book->categories()->detach(); // Detach all associated categories
        $book->delete();

        return $book;
    }


    public function findBook($id){

        $book = Book::findOrFail($id);

        return $book;
    }

    public function addCategoryToBook(Request $request, $bookId)
{
    $book = Book::findOrFail($bookId); // Retrieve the book

    $categoryIds = $request->input('category_id'); // Assuming you send the new category ID(s) in the 'categoryIds' field of the request

    // Attach the new category ID(s) to the book
    $book->categories()->attach($categoryIds);

    return $book;
}


public function findBookByCategory($id){
    $books= Category::findOrFail($id)->books;// Find a single post by its primary key...
    return $books;
}


}
