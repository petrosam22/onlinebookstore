<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_return_all_post(): void
    {
        $user =   User::create([
            'name'=>'peter',
            'email'=>'test@gmail.com',
            'password'=>'123456789',
            'image'=>'url.jpg',

            ]);
        Post::create([
            'title'=>'testUnit3',
            'body'=>'lorem lorem',
            'photo'=>'url.jpg',
            'user_id'=>$user->id,

        ]);
        $this->withoutMiddleware();
        $response = $this->getJson('api/post/all');

        $response->assertStatus(200);
     }


    public function test_delete_post(){
        $user =   User::create([
            'name'=>'peter',
            'email'=>'test2@gmail.com',
            'password'=>'123456789',
            'image'=>'url.jpg',

            ]);
            auth()->login($user);


    $post=  Post::create([
             'title'=>'testUnit2',
            'body'=>'lorem lorem',
            'photo'=>'url.jpg',
            'user_id'=>$user->id,

        ]);
    $this->withoutMiddleware();

    $response = $this->deleteJson(route('delete', ['id' => $post->id]));
    $response->assertStatus(200);
    }



}
