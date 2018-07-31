<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
    
        exit();
    }
?>
    