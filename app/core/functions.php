<?php

function printX($x)
{
    echo "<pre>";
    print_r($x);
    echo "</pre>";
}

function active($currect_page){ // TODO: fix on not established
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
    if($currect_page == $url) {
        echo 'active';
    }
}
