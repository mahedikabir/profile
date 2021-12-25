<?php
function page_last_segment(){
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/', $link);
    $page_last_segment = end($link_array);
    return $page_last_segment;
}

function page_active($url){
    if (page_last_segment() == $url){
        echo 'current-menu-item';
    } else {
        echo '';
    }
}

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$con = mysqli_connect("localhost", "root", "", "mahedikabir");


