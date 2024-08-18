<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SseController extends Controller
{
    public function stream()
    {
        // Set the appropriate headers for SSE
        $response = new StreamedResponse(function () {
            while (true) {
                $time = time();
                // Your server-side logic to get data
                $data = json_encode(['message' => 'This is a message', 'time' => $time]);

                echo "data: $data\n\n";

                // Flush the output buffer
                ob_flush();
                flush();

                sleep(1.5);
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }
}
