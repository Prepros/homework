<?php
// Для безопасности
function htmlout($str)
{
    return htmlentities(strip_tags(trim($str)), ENT_QUOTES, 'UTF-8');
}
