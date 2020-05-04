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
}