<?php

namespace App\interfaces;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;


interface PostRepositoryInterface {
    public function allPost();
    public function createPost(PostRequest $request);
    public function updatePost(UpdatePostRequest $request,$id);
    public function showPost($id);
    public function findPost($id);

    public function destroy($id);
    public function userHasPosts();
    public function getPostsByUserId($id);



}

