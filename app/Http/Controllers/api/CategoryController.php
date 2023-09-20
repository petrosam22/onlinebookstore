<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $CategoryRepository;

     public function __construct(CategoryRepositoryInterface $CategoryRepository) {
        $this->CategoryRepository = $CategoryRepository;
    }


    public function create(CategoryRequest $request){
        $response = $this->CategoryRepository->create($request);


        return response()->json([
            'category'=>$response['category'],
            'message'=>$response['message'],
        ]);

    }

    public function update(CategoryRequest $request,$id){
        $response = $this->CategoryRepository->update($request,$id);

        return response()->json([
            'category'=>$response['category'],
            'message'=> 'Category Updated Successfully',
        ]);
    }


    public function categories(){
       $response= $this->CategoryRepository->categories();


        return response()->json([
            'categories'=>$response['categories']
        ]);
    }

    public function show($id){
        $response = $this->CategoryRepository->show($id);


        return response()->json([
            'category'=>$response['category']
        ]);
    }
    public function delete($id){
        $response = $this->CategoryRepository->delete($id);


        return response()->json([
            'message'=>$response['message']
        ]);
    }
}
