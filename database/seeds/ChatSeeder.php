<?php

use App\User;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(User::class, 50)->create()->each(function($u) {
            $u->chats()->saveMany(factory(App\Chat::class,50)->make());
        });
    }
}
