<?php

namespace Tests\Feature;

use App\Chat;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeederTest extends TestCase
{
    /**
     * Test the seeders and one2many relationships
     *
     * @return void
     */
    use DatabaseMigrations;
    public function testUserChatSeeder()
    {
        factory(User::class, 5)->create()->each(function($u) {
            $u->chats()->saveMany(factory(Chat::class,50)->make());
        });

        self::assertEquals(5,User::all()->count());
        self::assertEquals(250,Chat::all()->count());
        self::assertEquals(50,User::first()->chats->count());
        self::assertInstanceOf(User::class, Chat::first()->user);
    }
}
