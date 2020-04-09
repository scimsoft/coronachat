<?php

namespace Tests\Unit;

use App\Chat;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class ModelRelationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function testOneUserHasManyChats(): void
    {
        parent::setUp();
        $user = factory(User::class)->create();
        $chat = factory(Chat::class)->create(['user_id' => $user->id]);
        $chat2 = factory(Chat::class)->create(['user_id' => $user->id]);


        $this->assertEquals(2, $user->chats->count());

        $this->assertTrue($user->chats->contains($chat));
        $this->assertTrue($user->chats->contains($chat2));

    }
    public function testChatBelongs2User(): void
    {
        $user = factory(User::class)->create();
        $chat = factory(Chat::class)->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $chat->user);
        $this->assertEquals(1,$chat->user->count());

    }

}
