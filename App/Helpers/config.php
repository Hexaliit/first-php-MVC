<?php
// define root
define('ROOT', 'http://localhost/khodro');
// define redirect
function redirect($page){
    header('location:'.ROOT.'/'.$page);
}