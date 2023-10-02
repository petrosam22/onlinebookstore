<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Traits\ValidatesImageTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdatePostRequest;
use App\interfaces\PostRepositoryInterface;


class PostRepositories implements PostRepositoryInterface {
    use ValidatesImageTrait;
    public function createPost(PostRequest $request){

        $photo = $this->validateImage($request->photo , 'post');

        $post  = Post::create([
            'title' => $request->title,
            'body' =>$request->body,
            'photo' =>$photo ,
            'user_id' => Auth::user()->id
        ]);


        return $post;
    }


    public function updatePost(UpdatePostRequest $request,$id){


        $post = Post::where('user_id' , Auth::user()->id)->findOrFail($id);
        $post->update($request->all());

        return $post;
    }


    public function allPost(){
        $posts = Post::with('comments')->get();
        return $posts;
    }




    public function showPost($id){
        $post = Post::findOrFail($id);
        if(!$post){
            return 'Post Not Found';
        }
        return $post;
    }
    public function findPost($id){
        $post = Post::findOrFail($id);
        if(!$post){
            return 'Post Not Found';
        }
        return $post;
    }
    public function destroy($id){
        $post = Post::where('user_id' , Auth::user()->id)->findOrFail($id);
        $post->delete();
        return $post;
    }

    public function userHasPosts(){
        $users = User::whereHas('posts')->get();

        return $users;


    }

    public function getPostsByUserId($id){
        $user = User::findOrFail($id);

        $user->posts;

        return $user;
    }
}

