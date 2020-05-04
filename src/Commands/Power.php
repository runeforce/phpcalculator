<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Helper\Helper;

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

        for($i = 1;$i <= $exp;$i++)
        {
            $result *= $base;
        }

        $description = $base." ^ ".$exp;
        $return = $description." = ".$result;
        
        $this->line($return);
    }
}