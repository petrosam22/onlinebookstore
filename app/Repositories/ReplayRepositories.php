<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Replay;
use App\Models\Comment;
use App\Http\Requests\ReplayRequest;
use Illuminate\Support\Facades\Auth;
use App\interfaces\ReplayRepositoryInterface;


class ReplayRepositories implements ReplayRepositoryInterface{
    public function storeReplay( $id,ReplayRequest $request){

        $comment = Comment::findOrFail($id);
        $user=Auth::user()->id;
        $replay  = Replay::create([
            'content'=>$request->content,
            'comment_id'=>$comment->id,
            'user_id'=> $user,
        ]);

    }

    public function updateReplay( $id, ReplayRequest $request){
        $replay = Replay::findOrFail($id);

        $replay->content  =$request->content;
        $replay->save();

        return $replay;
    }

    public function deleteReplay($id){
        $replay = Replay::findOrFail($id);
        $replay->delete();

        return $replay;


    }

    public function replays(){
        $replays = Replay::paginate(5);

        return $replays;
    }

}
