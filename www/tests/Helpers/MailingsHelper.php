<?php

function deleteCsvFiles(){
    $storagePath = storage_path('app/api');

    if (file_exists($storagePath)) {
        $files = glob($storagePath . '/*.csv');

        foreach ($files as $file) {
            unlink($file);
        }
    }
}
