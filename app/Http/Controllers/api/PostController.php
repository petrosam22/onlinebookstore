<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    private PostRepositoryInterface $PostRepositories;


     public function __construct(PostRepositoryInterface $PostRepositories) {
        $this->PostRepositories = $PostRepositories;
    }



    public function index(){

        $posts   = $this->PostRepositories->allPost();
        return response()->json([
            'length'=>$posts->count(),
            'data'=>$posts,
        ]);


    }
    public function store(PostRequest $request){
        $post = $this->PostRepositories->createPost($request);

        return response()->json([
            'data'=>$post,
            'message'=>'Post Created Successfully',
        ]);

    }


    public function update(UpdatePostRequest $request,$id){
        $post = $this->PostRepositories->updatePost($request,$id);

        return response()->json([
            'data'=>$post,
            'message'=>'Post Updated Successfully',
        ]);

    }


    public function show($id){
        $post = $this->PostRepositories->showPost($id);
        return $post;
    }
    public function find($id){
        $post = $this->PostRepositories->findPost($id);
        return $post;
    }


    public function destroy($id){
        $post = $this->PostRepositories->destroy($id);

        return response()->json([
            'message'=>'Post Deleted Successfully'
        ]);
    }

    public function usersPost(){
        $users = $this->PostRepositories->userHasPosts();


        return $users;
    }

     public function getPostsByUser($id){
        $usrPosts  = $this->PostRepositories->getPostsByUserId($id);
        return $usrPosts;
     }
}
