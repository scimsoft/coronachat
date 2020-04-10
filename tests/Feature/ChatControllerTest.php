<?php

namespace Tests\Unit;

use App\Chat;
use App\User;
use function assertEquals;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use DatabaseMigrations;

public function setUp():void{
    parent::setUp();
    Session::start();
    factory(User::class, 5)->create()->each(function($u) {
        $u->chats()->saveMany(factory(Chat::class,50)->make());
    });
}


    public function testLike(){

        $user = User::all()->random();
        $chat = $user->chats->first();
        $currentlikes = $chat->likes;

        Log::debug('ChatControllerTest chat before increment:'.$chat);

        $response = $this->call('POST', '/like/'.$chat->id, array(
            '_token' => csrf_token(),
        ));
        $chat = $chat->fresh();

        Log::debug('ChatControllerTest chat after increment:'.$chat);

        self::assertEquals($currentlikes+1,$chat->likes);
        self::assertEquals(200, $response->getStatusCode());
    }

    public function testDislike(){
        $user = User::all()->random();
        $chat = $user->chats->first();
        $currentdislikes = $chat->dislikes;

        $response = $this->call('POST', '/dislike/'.$chat->id, array(
            '_token' => csrf_token(),
        ));

        $chat = $chat->fresh();

        self::assertEquals($currentdislikes+1,$chat->dislikes);
        self::assertEquals(200, $response->getStatusCode());
    }

}
