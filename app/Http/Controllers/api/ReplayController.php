<?php

namespace App\Http\Controllers\api;

use App\Models\Replay;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplayRequest;
use App\interfaces\ReplayRepositoryInterface;

class ReplayController extends Controller
{
    private ReplayRepositoryInterface $ReplayRepositories;

    public function __construct(ReplayRepositoryInterface $ReplayRepositories) {
      $this->ReplayRepositories = $ReplayRepositories;
   }
  public function index()
  {
      $replays = $this->ReplayRepositories->replays();

      return response()->json([
        'length'=>$replays->count(),
        'data'=>$replays,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store($id,ReplayRequest $request)
  {
      $replay = $this->ReplayRepositories->storeReplay($id, $request);
      return response()->json([
          'data'=>$replay,
          'message'=>'Replay Created Successfully'
      ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Replay $replay)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Replay $replay)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ReplayRequest $request, Replay $replay)
  {
      $replay = $this->ReplayRepositories->updateReplay($replay->id,$request);

      return response()->json([
        'data'=>$replay,
        'message'=>'Replay Updated Successfully'
    ]);

  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Replay $replay)
  {
    $replay = $this->ReplayRepositories->deleteReplay($replay->id);
    return response()->json([

        'message'=>'Replay Deleted Successfully'
    ]);




  }

}
