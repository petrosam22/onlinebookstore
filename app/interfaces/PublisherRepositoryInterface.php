<?php 

namespace App\interfaces;

use App\Models\Publisher;
use App\Http\Requests\PublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;
interface PublisherRepositoryInterface

{
    public function listPublisher();
    public function createPublisher(PublisherRequest $request);

    public function updatePublisher(UpdatePublisherRequest $request,$id);

    public function findPublisherId($id);
    public function deletePublisher($id);
    public function PublisherBooks($id);
}
