<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileTest extends TestCase
{
    /**
     * Test zip files response status is 200.
     *
     * @return void
     */
    public function test_the_method_returns_a_successful_response()
    {
        $uploadedFiles = [];
        $uploadedFile1 = UploadedFile::fake()->create('document1.pdf', 500);
        $uploadedFile2 = UploadedFile::fake()->create('document2.pdf', 500);
        $uploadedFiles['files'][] = $uploadedFile1;
        $uploadedFiles['files'][] = $uploadedFile2;
        $uploadedFiles['zip_method'] = 'ZipArchive';

        $response = $this->post('/api/zip-files', $uploadedFiles, ['Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    /**
     * Test zip files response status is 400.
     *
     * @return void
     */
    public function test_the_method_returns_a_bad_request_response()
    {
        $expectedResponse = [
            'message' => [
                'files' => [
                    0 => "The files field is required."
                ]
            ]
        ];

        $uploadedFiles = [];

        $response = $this->post('/api/zip-files', $uploadedFiles, ['Accept' => 'application/json']);

        $responseBody = json_decode($response->getContent(), 1);

        $response->assertStatus(400);

        $this->assertSame($responseBody, $expectedResponse);
    }
}
