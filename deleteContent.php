<?php

require('functionAndVarForFile.php');
require('redirectURL.php');

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

writeDateInFile($jsonEditArray, $filename);
header("Location: {$url}");
exit;
