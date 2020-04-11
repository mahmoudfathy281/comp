<?php
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
    include 'conect.php';

    $sessionuser = '';
    
    $tpl    = 'inc/tamblet/' ; // tamplet dirctory 
    $css    = 'layout/css/';
    $js     = 'layout/js/';
    $lang   = 'inc/lang/'; // language dirctory
    $func   = 'inc/functions/'; // function directory

    include $func . 'func.php';
    include $lang . 'en.php' ;
    include $tpl . 'header.php';
    if(!isset($noNavbar)){
        include $tpl . 'navbar.php';
    }

?>