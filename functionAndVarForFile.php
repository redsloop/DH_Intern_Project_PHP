<?php
$filename = 'toDoList.txt';

function readInputFile ($filename) {
    $fp = fopen($filename, 'r+');

    $txt = '';
    while (!feof($fp)) {
        $txt .= fgets($fp);
    }
    fclose($fp);
    return $txt;
}

function fileDelete ($filename) {
    $fp = fopen($filename, 'r+');

    flock($fp, LOCK_EX);
    ftruncate($fp, 0);
    flock($fp, LOCK_UN);

    fclose($fp);

}

function writeDateInFile ($date, $filename) {
    file_put_contents($filename, $date.PHP_EOL, FILE_APPEND);
}
 
