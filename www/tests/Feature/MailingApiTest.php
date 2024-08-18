<?php
use Illuminate\Http\Exceptions\HttpResponseException;

afterEach(function () {
    deleteCsvFiles();
});

it('should create a mailing', function ($payload) {
    $expected = [
        'errors' => [
            'data' => ['Os dados devem conter pelo menos 5 contatos.']
        ]
    ];

    $response = $this->withHeaders([
        'Authorization' => 'Bearer '. env('COMPANY_API_TOKEN'),])
        ->postJson('api/mailing/create', $payload);

     $response->assertStatus(200);
})->with('payload_api_ok');

it('Should be fails to create a mailing', function ($payload, $expected) {
    $response = $this->withHeaders([
        'Authorization' => 'Bearer '. env('COMPANY_API_TOKEN'),])
        ->postJson('api/mailing/create', $payload);

     $response
        ->assertStatus(422)
        ->assertJson($expected);
})->with('payload_api_missing');

