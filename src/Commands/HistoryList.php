<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Helper\Helper;

class HistoryList extends Command
{
    protected $signature = 'history:list {commands?* : Filter the history by commands}';
    protected $description = 'Show calculator history';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $input = $this->argument('commands');

        $dataArray = Helper::getHistory("history.txt");

        if(!$dataArray)
        {
            $this->info("History is empty");
            return;
        }

        $filteredDataArray = Helper::filterCommand($dataArray, $input);

        $line = "";
        $border = "";
        $headerContent = "";
        $countData = count($filteredDataArray['data']);

        if($countData === 0)
        {
            $this->line("History is empty");
            return;
        }
        
        foreach($filteredDataArray['length'] as $index=>$value)
        {
            $border .= "+";
            
            for($i = 1;$i <= $value;$i++)
            {
                $border .= "-";
            }

            $headerContent .= "| ".ucfirst($index);
            
            for($i=1;$i <= $value - strlen($index) - 1;$i++)
            {
                $headerContent .= " "; 
            }
        }
        $border .= "+";
        $headerContent .= "|";

        $this->line($border);
        $this->line($headerContent);
        $this->line($border);
        
        foreach($filteredDataArray['data'] as $index1=>$value1)
        {
            $line = "";

            foreach($filteredDataArray['length'] as $index2=>$value2)
            {
                $line .= "| ".$value1[$index2];
                
                for($i=1;$i <= $value2 - strlen($value1[$index2]) - 1;$i++)
                {
                    $line .= " "; 
                }
            }

            $line .= "|";
            $this->line($line);
        }

        $this->line($border);
    }
}