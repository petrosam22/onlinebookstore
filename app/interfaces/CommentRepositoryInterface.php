<?php

namespace App\interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

interface CommentRepositoryInterface{

    public function createComment(CommentRequest $request ,$id);
    public function updateComment(Request $request,$id);
    public function deleteComment($id);
    public function comments();
    public function userComments($id);
    public function postComments($id);
}
