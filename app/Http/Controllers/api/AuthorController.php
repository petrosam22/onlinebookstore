<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\interfaces\AuthorRepositoryInterface;

class AuthorController extends Controller
{
    private AuthorRepositoryInterface $AuthorRepository;

    public function __construct(AuthorRepositoryInterface $AuthorRepository){
        $this->AuthorRepository = $AuthorRepository;

    }

    public function index(){
        $authors = $this->AuthorRepository->listAuthors();

        return response()->json([
            'length'=>$authors['length'] ,
            'authors'=> $authors['authors'],
        ]);
    }






    public function create(AuthorRequest $request){
        $author = $this->AuthorRepository->createAuthor($request);

        return response()->json([
            'author'=>$author['author'],
            'message'=>$author['message'],
        ]);
    }



    public function update(UpdateAuthorRequest $request,$id){
        $author = $this->AuthorRepository->updateAuthor( $request,$id);

        return response()->json([
            'Author'=>$author['author'],
            'message'=>$author['message'],
        ]);
    }


    public function delete($id){
        $author=$this->AuthorRepository->deleteAuthor($id);

            return response()->json([
                'message'=>'User deleted Successfully '
            ]);
    }
    public function show($id){
        $author=$this->AuthorRepository->findAuthorId($id);

            return response()->json([
                'author' =>$author['data'],
            ]);
    }

    public function authorBooks($id){
        $authorBooks = $this->AuthorRepository->authorBooks($id);
        if (isset($authorBooks['error'])) {
            return response()->json([
                'error' => $authorBooks['error'],
            ]);
        }
    
        
    return response()->json([
        'data' => $authorBooks['books']
    ]);


    }




}
