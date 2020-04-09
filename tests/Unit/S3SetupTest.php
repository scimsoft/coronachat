<?php

namespace Tests\Unit;

use App\Chat;
use function assertTrue;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\CreatesApplication;
use Tests\TestCase;


class S3SetupTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     *
     *
     */

    use CreatesApplication;
    use DatabaseMigrations;




    public function testS3addMedia()
    {

        $pathToFile= "public/images/icons/icon-72x72.png";
        $chat = new Chat();
        $chat->addMedia($pathToFile)
            ->preservingOriginal()
            ->toMediaCollection();
        $chat->messagetype=1;
        $chat->messagetext="testCase";
        $chat->save();

        $retrievechat = Chat::where('messagetext',  'testCase')->first();
        $this->assertEquals($retrievechat->messagetext,"testCase");
        $mediaItems = $retrievechat->getMedia();

        $this->assertEquals(count($mediaItems),1);
        $this->assertNotEmpty($mediaItems[0]);
        $this->assertEquals($mediaItems[0]->file_name,"icon-72x72.png");
    }
}
