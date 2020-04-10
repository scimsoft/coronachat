<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->decimal('long', 10, 7)->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->string('ip_address', 39)->nullable();

            $table->integer('likes')->nullable();
            $table->integer('dislikes')->nullable();


            $table->integer('messagetype');
            $table->string('messagetext');





            $table->timestamps();
        });
//        Schema::table('chats', function ( $table) {
//            $table->foreign('user_id')
//                ->references('id')
//                ->on('users');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
