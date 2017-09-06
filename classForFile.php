<?php
/**
 * todoをクラス化した
 */
class toDoList
{
    private $taskName = '';
    private $daySet = '';
    private $status = '0';
    function __construct($name, $day)
    {
        $this->taskName = $name;
        $this->daySet = $day;
    }

    public function writeDateInFile ($date, $filename) {
        file_put_contents($filename, $date.PHP_EOL, FILE_APPEND);
    }

    public function getTaskName () {
        return $this->taskName;
    }

    public function getDaySet () {
        return $this->daySet;
    }

    public function getStatus () {
        return $this->status;
    }
}
