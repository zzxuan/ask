<?php

/**
 * @author zhangxu
 * @copyright 2015
 */
function uploadquestion($arr){
    if(!isset($arr['title'])
    ||!isset($arr['quetext'])
    ||!isset($arr['grade'])
    ||!isset($arr['subject']))
    {
        return false;
    }
    echo $arr['title'] ."-----------".$arr['grade']."---------".$arr['subject'];
    echo "<br>".$arr['quetext'];
    return true;
} 

?>