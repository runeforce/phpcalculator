<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Helper\Helper;
use Carbon\Carbon;

class Subtract extends Command
{
    protected $signature = 'subtract​ {numbers* : The numbers to be substracted}';
    protected $description = 'subtract​ all given Numbers';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $input = $this->argument('numbers');
        $countInput = count($input);
        $description = "";
        $sign = " - ";
        $result = 0;
        $return = "";

        if($countInput < 2)
        {
            $this->error("Input should have at least 2 numbers");
            return;
        }

        $isInputNumber = Helper::isArrayAllNumber($input);
        if(!$isInputNumber)
        {
            $this->error("Input can only be numbers");
            return;
        }

        foreach($input as $index=>$value)
        {
            $description .= $value;

            if($index + 1 < $countInput)
                $description .= $sign;
            
            if($index == 0)
                $result = $value;
            else
                $result -= $value;
        }

        $return = $description." = ".$result;
        
        $this->line($return);
    }
}