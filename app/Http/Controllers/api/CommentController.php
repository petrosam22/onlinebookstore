<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\interfaces\CommentRepositoryInterface;


class CommentController extends Controller
{
    private CommentRepositoryInterface $CommentRepositories;
     public function __construct(CommentRepositoryInterface $CommentRepositories) {
        $this->CommentRepositories = $CommentRepositories;
    }


    public function index(){
        $comments =  $this->CommentRepositories->comments();
        return response()->json([
            'data'=>$comments,
            'length'=> $comments->count(),
        ]);

    }

    public function store(CommentRequest $request ,$id){
        $comment = $this->CommentRepositories->createComment( $request ,$id);

        return response()->json([
            'data'=>$comment,
            'message'=> 'Comment Created Successfully'
        ]);

    }
    public function update(Request $request ,$id){
        $comment = $this->CommentRepositories->updateComment($request ,$id);


        return response()->json([
            'data'=>$comment,
            'message'=> 'Comment Updated Successfully'
        ]);
    }



    public function destroy($id){
        $comment = $this->CommentRepositories->deleteComment($id);


        return response()->json([
             'message'=> 'Comment Deleted Successfully'
        ]);
    }

    public function userComments($id){
        $comments = $this->CommentRepositories->userComments($id);
        return response()->json([
            'data'=>$comments,
            'length'=>$comments->count()

        ]);

    }

    public function listCommentsPost($id){
        $postComments =  $this->CommentRepositories->postComments($id);
        return response()->json([
            'data'=>$postComments,
            'length'=>$postComments->count()

        ]);
        

    }

}
