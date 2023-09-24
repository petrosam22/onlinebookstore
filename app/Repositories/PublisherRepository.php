<?php 

namespace App\Repositories;
use App\interfaces\PublisherRepositoryInterface;
use App\Http\Requests\PublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Models\Publisher;

class PublisherRepository implements PublisherRepositoryInterface{


    public function listPublisher(){
        return  $publishers=Publisher::all();
    }
    public function createPublisher(PublisherRequest $request){

        $publisher = Publisher::create($request->all());



        return[
            'publisher'=>$publisher,
            'message'=>'Publisher Created Successfully'
        ];
    }


    public function updatePublisher(UpdatePublisherRequest $request,$id){
        $publisher = Publisher::findOrFail($id);

        $publisher->update($request->all());

        return [
        'data'=>$publisher,
        'message'=>'Publisher Updated Successfully'   
        ];
        }

        public function findPublisherId($id){
            return $publisher = Publisher::findOrFail($id);

            
            
        }

        public function deletePublisher($id){
             $publisher = Publisher::findOrFail($id);
            $publisher->delete();

            return [
                'publisher'=>$publisher,
                'message'=>"The  Publisher Deleted Successfully"
            ];
        }

        public function PublisherBooks($id){
            $publisher = Publisher::findOrFail($id);
          $books=  $publisher->books;
          return [
            'data'=>$books,
         ];


        }
}