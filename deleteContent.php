<?php

require('globalVar.php');

$jsonDecodeArray = json_decode(file_get_contents($filename));


$index = 0;
$jsonEditArray = array();

foreach ($jsonDecodeArray as $jsonDecodeContent) {
    if($jsonDecodeContent->id != $_GET['taskId']) {
        $jsonEditArray [] = [
            "id"       => $index,
            "taskName" => $jsonDecodeContent->taskName,
            "day"      => $jsonDecodeContent->day,
            "status"   => $jsonDecodeContent->status
        ];
        $index++;
    }
}

file_put_contents($filename, json_encode($jsonEditArray).PHP_EOL);
header("Location: {$url}");
exit;
