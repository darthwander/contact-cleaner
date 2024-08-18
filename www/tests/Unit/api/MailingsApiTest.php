<?php
use Tests\TestCase;
use App\Models\Mailing;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

afterEach(function () {
    deleteCsvFiles();
});

test('Shoud create a valid fullpath', function () {

    $response = Mailing::createCsvFileName();

    $this->assertIsString($response);

    $this->assertStringStartsWith('api/api_carga_', $response);

    $this->assertStringContainsString(date('Y-m-d'), $response);

    $this->assertMatchesRegularExpression('/api\/api_carga_\d{4}-\d{2}-\d{2}_\d{5}[.]csv/', $response);

    expect($response)
        ->not->toBeEmpty()
        ->toBeString();
});

test('writeCsvMailing generates correct CSV content with valid data', function (array $data, int $expected) {

    $filePath = Mailing::createCsvFileName();

    $columnPhoneCount = Mailing::writeCsvMailing($filePath, $data);

    $this->assertEquals($expected, $columnPhoneCount);

})->with('payloads_ok');


it('Should be return config fields on json format.', function ($columnPhoneCount, $expected) {

    $response = Mailing::ConfigFields($columnPhoneCount);

    $this->assertEquals($expected, $response);

})->with('config_fields');


it('Should be fails, why columnPhoneCount < 1', function ($columnPhoneCount) {

    $response = Mailing::configFields($columnPhoneCount);

    $this->assertInstanceOf(JsonResponse::class, $response);

})->with([[0], [-1]]);

it('Should be return charge config on json format', function () {

    $response = Mailing::chargeConfig();

    $expected = '{"wp_200":true,"wp_487":false,"487_cod":true,"only_200":true,"487_cod_wp":true,"only_200_wp":true}';

    $this->assertEquals($expected, $response);

    expect($response)
        ->toBeString()
        ->not->toBeEmpty();
});

it('Should be validate filepath string', function (string $filePath) {

    $response = Mailing::filePathStringValidator($filePath);

    expect($response)
        ->not->toBeEmpty()
        ->toBeBool()
        ->toBeTrue();

})->with([
    ['api/api_carga_2022-01-01_12345.csv'],
    ['api/api_carga_2022-01-01_67890.csv'],
]);

it('Should´n be validate filepath string why ', function (string $filePath) {
    $response = Mailing::filePathStringValidator($filePath);

    expect($response)
        ->toBeFalsy()
        ->toBeBool()
        ->toBeFalse();

})->with('file_path_strings');


it('Testar save charge mailing', function () {
    $description = 'Description Test';
    $columnPhoneCount = 1;
    $filePath = Mailing::createCsvFileName();

    Auth::login(Company::find(1));

    $response = Mailing::saveChargeMailing($description, $columnPhoneCount, $filePath);

    expect($response)
        ->not->toBeEmpty()
        ->toBeInstanceOf(Mailing::class);

    expect($response->company_id)->toBeInt()->toBe(1);
    expect($response->description)->toBeString();
    $this->assertEquals($response->description, $description);
    $this->assertEquals($response->config, json_encode(['wp_200' => true, 'wp_487' => false, '487_cod' => true, 'only_200' => true, '487_cod_wp' => true, 'only_200_wp' => true], true));
    expect($response->status_load)->toBeInt()->toBe(0);
    expect($response->status_wipe)->toBeInt()->toBe(0);
    expect($response->filename)->toBeString();
    $this->assertEquals($response->filename, $filePath);
    expect($response->setup)->toBeBool()->toBeTrue(true);
    expect($response->error)->toBeInt()->toBe(0);
    $this->assertEquals($response->fields, json_encode(['col0' => 'cod', 'col1' => 'name', 'col2' => 'phone'], true));
    expect($response->classification)->toBeInt()->toBe(1);
    expect($response->webhook)->toBeBool()->toBeFalse();
    expect($response->export_type)->toBeInt()->toBe(1);
});



