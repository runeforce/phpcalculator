<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Helper\Helper;
use Carbon\Carbon;

class Power extends Command
{
    protected $signature = 'pow {base : The base number} exp {exp : The exponent number}';
    protected $description = 'Exponent the given Numbers';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $base = $this->argument('base');
        $exp = $this->argument('exp');
        $description = "";
        $sign = " - ";
        $result = 1;
        $return = "";
        $historyArray = [];

        for($i = 1;$i <= $exp;$i++)
        {
            $result *= $base;
        }

        $description = $base." ^ ".$exp;
        $return = $description." = ".$result;
        
        $dataArray = 
        [
            'command' => 'Power',
            'description' => $description,
            'result' => $result,
            'output' => $return,
            'time' => Carbon::now()->format('Y-m-d H:i:s') 
        ];

        if(file_exists("history.txt"))
            $historyArray = json_decode(file_get_contents("history.txt"), TRUE);
        
        array_push($historyArray, $dataArray);
        
        Helper::writeToFile("history.txt", $historyArray);
        
        $this->line($return);
    }
}