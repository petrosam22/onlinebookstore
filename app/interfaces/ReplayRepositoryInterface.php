<?php

namespace App\interfaces;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\ReplayRequest;


interface ReplayRepositoryInterface{
    public function storeReplay( $id, ReplayRequest $request);
    public function updateReplay( $id, ReplayRequest $request);
    public function deleteReplay($id);
    public function replays();
}
