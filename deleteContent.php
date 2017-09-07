<?php

require('functionAndVarForFile.php');
require('redirectURL.php');

$jsonDecodeArray = json_decode(readInputFile($filename));

fileDelete($filename);

$index = 0;
$jsonEditArray = array();

foreach ($jsonDecodeArray as $jsonDecodeObj) {
    $jsonDecodeContent = (array)$jsonDecodeObj;
    if($jsonDecodeContent['id'] != $_GET['taskId']) {
        $jsonEditArray [] = [
            "id"       => $index,
            "taskName" => $jsonDecodeContent['taskName'],
            "day"      => $jsonDecodeContent['day'],
            "status"   => $jsonDecodeContent['status']
        ];

        $index++;
    }
}
$jsonEncode = json_encode($jsonEditArray);
writeDateInFile($jsonEncode, $filename);
header("Location: {$url}");
exit;
