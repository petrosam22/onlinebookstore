<?php

namespace App\interfaces;

use App\Http\Requests\CategoryRequest;

use App\Models\Category;


interface CategoryRepositoryInterface{


    public function create(CategoryRequest $request);

    public function update(CategoryRequest $request,$id);
    public function categories();
    public function show($id);
    public function delete($id);





}
