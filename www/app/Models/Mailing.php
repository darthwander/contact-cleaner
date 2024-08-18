<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class Mailing extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'description',
        'config',
        'status_load',
        'status_wipe',
        'webhook',
        'webhook_send',
    ];

    public static function createCsvFileName(): string
    {
        $date = date('Y-m-d');
        $randNumber = rand(10000, 99999);
        $fileName = "api_carga_{$date}_{$randNumber}.csv";
        $filePath = "api/{$fileName}";

        return $filePath;
    }

    public static function writeCsvMailing(string $filePath, array $data): int
    {
        $isValidFilePathString = self::filePathStringValidator($filePath);

        $stream = fopen('php://temp', 'r+');

        fputcsv($stream, ['cod', 'name', 'phones'], ';');

        $columnPhoneCount = 0;

        foreach ($data as $row) {
            if (isset($row['cod'], $row['name'], $row['phones']) &&
                !empty($row['cod']) && !empty($row['name']) && !empty($row['phones'])) {

                $line = "{$row['cod']};{$row['name']}";

                if (is_array($row['phones'])) {
                    if (count($row['phones']) > $columnPhoneCount) {
                        $columnPhoneCount = count($row['phones']);
                    }

                    $line .= ';' . implode(';', $row['phones']);
                }

                fwrite($stream, $line . PHP_EOL);
            }
        }

        rewind($stream);
        Storage::put($filePath, stream_get_contents($stream));
        fclose($stream);

        return $columnPhoneCount;
    }

    public static function saveChargeMailing($description, int $columnPhoneCount, string $filePath): Mailing
    {
        $colsConfig = self::configFields($columnPhoneCount);
        $chargeConfig = self::chargeConfig();

        $mailing = new Mailing();
        $mailing->company_id = Auth::user()->id;
        $mailing->description = $description;
        $mailing->config = $chargeConfig;
        $mailing->status_load = 0;
        $mailing->status_wipe = 0;
        $mailing->filename = $filePath;
        $mailing->setup = true;
        $mailing->error = 0;
        $mailing->fields = $colsConfig;
        $mailing->classification = 1;
        $mailing->webhook = false;
        $mailing->export_type = 1;
        $mailing->save();

        return $mailing;
    }

    public static function configFields(int $columnPhoneCount) : string | JsonResponse
    {
        if( $columnPhoneCount <= 0) {
            return response()->json([
                'message' => '$columnPhoneCount must be greater than 0',
            ]);
        }

        $cols['col0'] = 'cod';
        $cols['col1'] = 'name';
        for ($a = 0; $a < $columnPhoneCount; $a++) {
            $atualCol = $a + 2;
            $cols['col' . $atualCol] = 'phone';
        }

        return json_encode($cols, true);
    }

    public static function chargeConfig()
    {
        $config = [
            'wp_200' => true,
            'wp_487' => false,
            '487_cod' => true,
            'only_200' => true,
            '487_cod_wp' => true,
            'only_200_wp' => true,
        ];

        return json_encode($config, true);
    }

    public static function filePathStringValidator(string $filePath): bool
    {
        $result = preg_match('/^api\/api_carga_\d{4}-\d{2}-\d{2}_\d{5}[.]csv$/', $filePath);

        return $result ? true : false;
    }
}
