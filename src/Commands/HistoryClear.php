<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;

class HistoryClear extends Command
{
    protected $signature = 'history:clear';
    protected $description = 'Show calculator history';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        unlink("history.txt");

        $this->info("History cleared!");
    }
}