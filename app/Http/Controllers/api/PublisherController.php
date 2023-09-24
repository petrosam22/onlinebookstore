<?php

namespace App\Http\Controllers\api;
use App\interfaces\PublisherRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePublisherRequest;

use App\Http\Requests\PublisherRequest;


class PublisherController extends Controller
{

    /**
     * Display a listing of the resource.
     */

     private PublisherRepositoryInterface $PublisherRepository;

      public function __construct(PublisherRepositoryInterface $PublisherRepository) {
        $this->PublisherRepository = $PublisherRepository;
     }
    public function index()
    {
      $publishers=  $this->PublisherRepository->listPublisher();

      return response()->json([
        'data'=>$publishers
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PublisherRequest $request)
    {
        $publisher = $this->PublisherRepository->createPublisher($request);

        return response()->json([
            'publisher'=>$publisher,
          
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    
     

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $publisher = $this->PublisherRepository->findPublisherId($id);
        return response()->json([
            'data'=>  $publisher,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublisherRequest $request,  $id)
    {
        $publisher = $this->PublisherRepository->updatePublisher($request,  $id);

        return response()->json([
            $publisher['data'],
            $publisher['message'] 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publisher =$this->PublisherRepository->deletePublisher($id);
        
        return response()->json([
            'message'=>$publisher['message']
        ]);
    }

    public function books($id){
        return $this->PublisherRepository->PublisherBooks($id);

    }
}
