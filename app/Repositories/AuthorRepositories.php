<?php
namespace App\Repositories;
use App\Models\Author;
use App\Traits\ValidatesImageTrait;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\interfaces\AuthorRepositoryInterface;


class AuthorRepositories implements AuthorRepositoryInterface{
use ValidatesImageTrait;
    public function createAuthor(AuthorRequest $request){

            $image  = $this->validateImage($request->image ,'user');
        $author = Author::create([
                'name' => $request->name,
                'description' => $request->description,
                'image'=>$image
            ]);



            return[
                'author'=>$author,
                'message'=>'Author Created Successfully',
            ];

    }

    public function listAuthors(){
        $authors = Author::all();

        return
        [
            'length'=>$authors->count(),
            'authors'=>$authors,
        ];
    }


    public function updateAuthor(UpdateAuthorRequest $request,$id){
        $author=Author::findOrFail($id);

        if($request->hasFile('image')){
            $image = $this->validateImage($request->image,'user');

            $author->image = $image;
        }
        $author->update($request->all());




        return [
            'author'=>$author,
            'message'=>'Author Updated Successfully'
        ];


    }

    public function deleteAuthor($id){
        $author = Author::findOrFail($id);
        $author->delete();
        return [
            'message'=>'User deleted Successfully '
        ];
    }
    public function findAuthorId($id){
        $author = Author::findOrFail($id);

        return [
            'data'=>$author,
        ];

    }

    public function authorBooks($id){
        $author = Author::findOrFail($id);

        $books = $author->books;


    if(!$books){
        return response()->json([
            'error'=>'The Author Has No Book'
        ]);


    }


        return[
            'books'=>$books,
        ];



    }

}
