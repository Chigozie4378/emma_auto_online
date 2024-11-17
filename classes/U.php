<?php
class U
{
    public static function col(...$col)
    {
        $result = array();
        foreach ($col as $value) {
            list($key, $val) = explode('=', $value); // remove space around =
            $result[trim($key)] = trim($val); // trim spaces around key and value
        }
        return $result;
    }
    public static function where(...$where)
    {
        $result = array();
        foreach ($where as $value) {
            list($key, $val) = explode('=', $value); // remove space around =
            $result[trim($key)] = trim($val); // trim spaces around key and value
        }
        return $result;
    }
    
}
