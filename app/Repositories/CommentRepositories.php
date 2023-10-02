<?php
namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\interfaces\CommentRepositoryInterface;


class CommentRepositories implements CommentRepositoryInterface {

   
   
   
    public function comments(){
        $comments = Comment::all();

        return $comments;
    }
    public function createComment(CommentRequest $request ,$id){
        $post = Post::findOrFail($id);

        $comment = Comment::create([
            'commentable_id'=>$request->commentable_id,
            'commentable_type'=>'App\Models\Post',
            'body'=> $request->body,
            'user_id'=>Auth::user()->id,
        ]);


        return $comment;
    }

    public function updateComment(Request $request ,$id){
        $comment = Comment::findOrFail($id);

        $comment->body = $request->body;
        $comment->save();


        return $comment;
    }

    public function deleteComment($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return $comment;
    }

    public function userComments($id){
        $userComments = User::findOrFail($id);
        $userComments->comments;

        return $userComments;
    }

    public function postComments($id){
        $postComments = Post::findOrFail($id);
        $postComments->comments;

        return $postComments;

    }
}
