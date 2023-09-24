<?php

namespace App\interfaces;

use App\Http\Requests\AuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

interface AuthorRepositoryInterface {

    public function listAuthors();
    public function createAuthor(AuthorRequest $request);

    public function updateAuthor(UpdateAuthorRequest $request,$id);

    public function deleteAuthor($id);
    public function findAuthorId($id);
    public function authorBooks($id);

}
