<?php

namespace Jakmall\Recruitment\Calculator\Helper;

class Helper
{
    public function isArrayAllNumber(array $arr)
    {
        $implodeArray = implode('', $arr);
        if(!is_numeric($implodeArray))
            return false;
        
        return true;
    }

    public function writeToFile($filename, $data)
    {
        $file = fopen($filename, "w");
        fwrite($file, json_encode($data));
        fclose($file);
    }

    public function getHistory($filename)
    {
        $return = null;

        if(file_exists($filename))
            $return = json_decode(file_get_contents($filename), TRUE);
        
        return $return;
    }

    public function filterCommand($data, $commandFilter)
    {
        $dataArray = [];
        $count = 0;

        $maxLengthArray = 
        [
            'no' => 4,
            'command' => 9,
            'description' => 13,
            'result' => 8,
            'output' => 8,
            'time' => 6
        ];
        
        foreach($data as $index=>$value)
        {
            if(in_array(strtolower($value['command']), $commandFilter))
            {
                if(strlen($value['command']) + 2 > $maxLengthArray['command'])
                    $maxLengthArray['command'] = strlen($value['command']) + 2;

                if(strlen($value['description']) + 2 > $maxLengthArray['description'])
                    $maxLengthArray['description'] = strlen($value['description']) + 2;
                
                if(strlen($value['result']) + 2 > $maxLengthArray['result'])
                    $maxLengthArray['result'] = strlen($value['result']) + 2;
                
                if(strlen($value['output']) + 2 > $maxLengthArray['output'])
                    $maxLengthArray['output'] = strlen($value['output']) + 2;
                
                if(strlen($value['time']) + 2 > $maxLengthArray['time'])
                    $maxLengthArray['time'] = strlen($value['time']) + 2;

                $count++;

                $value['no'] = $count;
                array_push($dataArray, $value);
            }
        }
        
        $maxLengthArray['no'] = strlen($count) + 2 > 4 ? strlen($count) + 2 : 4;

        $return['data'] = $dataArray;
        $return['length'] = $maxLengthArray;

        return $return;
    }
}