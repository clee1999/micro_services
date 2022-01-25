<?php
// tests/AvatarTest.php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Avatar;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AvatarTest extends ApiTestCase
{
    public function testCreateAvatar(): void
    {
        $file = new UploadedFile('public/images/obarock.png', 'obarock.png');
        $client = self::createClient();

        $client->request('POST', '/media_objects', [
            'headers' => ['Content-Type' => 'multipart/form-data'],
            'extra' => [
                // If you have additional fields in your Avatar entity, use the parameters.
                'parameters' => [
                    'title' => 'My file uploaded',
                ],
                'files' => [
                    'file' => $file,
                ],
            ]
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(Avatar::class);
        $this->assertJsonContains([
            'title' => 'My file uploaded',
        ]);
    }
}
