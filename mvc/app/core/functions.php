<?php
namespace app\core;

class Functions
{
    public function htmlout($str)
    {
        if (is_int($str)) {
            return $str;
        }
        return htmlentities(strip_tags(trim($str)), ENT_QUOTES, 'UTF-8');
    }
}
