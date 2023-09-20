<?php
namespace App\Repositories;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\interfaces\CategoryRepositoryInterface;


class CategoryRepositories implements CategoryRepositoryInterface{

    public function create(CategoryRequest $request){

        $category = Category::create([
            'name'=>$request->name,
        ]);

        return [
            'category'=>$category,
            'message'=>'Category Created Successfully'
        ];
    }


    public function update(CategoryRequest $request,$id){
        $category = Category::findOrFail($id);


        $category->name = $request->name;

        $category->save();
        return [
            'category'=>$category,
        ];
    }


    public function categories(){
        $categories = Category::all();


        return [
            'categories'=>$categories,
        ];
    }


    public function show($id){
        $category = Category::findOrFail($id);


        return[
            'category'=>$category
        ];
    }
    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete();

        return[
            'message'=>'Category deleted Successfully'
        ];


    }
}
