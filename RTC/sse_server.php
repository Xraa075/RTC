<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

function readDataFromFile()
{
    $file = fopen("datachat.txt", "r");
    $data = [];
    while (!feof($file)) {
        $line = fgets($file);
        if ($line !== false) {
            $data[] = explode("|", $line);
        }
    }
    fclose($file);
    return $data;
}

function sendData($data)
{
    echo "data: " . json_encode($data) . "\n\n";
    ob_flush();
    flush();
}

$initialData = readDataFromFile();
sendData($initialData);

while (true) {
    sleep(0.5);
    $currentData = readDataFromFile();
    if ($currentData !== $initialData) {
        sendData($currentData);
        $initialData = $currentData;
    }
}
