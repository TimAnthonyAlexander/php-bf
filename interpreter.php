#!/usr/bin/php
<?php

$bf = new bf($argv[1] ?? null);
echo "\n\nMemory:\n".json_encode($bf->memory);

/**
 * Basic php brainfuck interpreter
 * Can interpret files and commandline arguments
 * Call like ./interpreter.php filename
 * or ./interpreter.php '++++++++[->++++++++<]>+.'
 * @copyright Tim Anthony Alexander
 */
class bf{
    public $memory = [];
    public $pointer = 0;
    public $currentloop = 0;
    public $startlooppositions;

    /**
     * bf constructor.
     * @param $file
     */
    public function __construct($file){
        error_reporting(0);
        ini_set('display_errors', 0);
        $default = '++++++++++[>+>+++>+++++++>++++++++++<<<<-]>>>++.>+.+++++++..+++.<<++.>+++++++++++++++.>.+++.------.--------.<<+.<.';
        ($file === null) ? $bfcode = $default : $bfcode = (file_exists($file)) ? file_get_contents($file) : $file;
        foreach(range(0, 10000) as $value){
            $memory[$value] = 0;
        }
        echo "Input:\n".$bfcode."\n\n";
        echo "Output:\n";
        $this->interpret($bfcode);
    }

    /**
     * @TODO Describe interpret
     * @param $bfcode
     * @return void
     */
    function interpret($bfcode) {
        $bfcode_split = str_split($bfcode);
        foreach($bfcode_split as $item => $value){
            $this->bfeval($value, $item, $bfcode);
        }
    }

    /**
     * @TODO Describe bfeval
     * @param $value
     * @param $item
     * @param $currentcode
     * @return void
     */
    function bfeval($value, $item, $currentcode){
        switch($value){
            case "+":
                $this->memory[$this->pointer]++;
                break;
            case "-":
                $this->memory[$this->pointer]--;
                break;
            case ">":
                $this->pointer++;
                break;
            case "<":
                $this->pointer--;
                break;
            case "[":
                $this->currentloop = $this->currentloop + 1;
                $this->startlooppositions[$this->currentloop] = $item;
                break;
            case "]":
                if($this->memory[$this->pointer] > 0){
                    $extractedloop = strstr(strstr($currentcode, '['), ']', true).']';
                    $this->interpret($extractedloop);
                    return;
                }else{
                    $this->currentloop = $this->currentloop - 1;
                }
                break;
            case ".":
                echo chr($this->memory[$this->pointer]);
                break;
        }
    }
}
