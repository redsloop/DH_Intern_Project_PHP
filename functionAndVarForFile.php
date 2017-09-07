<?php
$filename = 'toDoList.txt';

function writeDateInFile ($date, $filename) {
    unlink($filename);
    file_put_contents($filename, json_encode($date).PHP_EOL, FILE_APPEND);

}
