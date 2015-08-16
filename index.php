<?php

/**
 * @author 
 * @copyright 2015
 */
$url="mainview.html"; 
Header("HTTP/1.1 303 See Other"); 
Header("Location: $url"); 
exit; 


?>