<?php
function redirect(string $path) {
    // print($_SERVER['HTTP_HOST'].'/'.$path);
    header('location:http://'.$_SERVER['HTTP_HOST'].'/'.$path);
    exit();
}
function hardRefresh() {
    // print('redirection!');
    // header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    // header("Pragma: no-cache"); // HTTP 1.0.
    // header("Expires: 0");
    header("Refresh:2");
    exit();
}

function connectedOrRedirect(string $path){
    session_start();
    if(!isset($_SESSION) || !isset($_SESSION['admin']) || empty($_SESSION['admin'])){
        redirect($path);
    }
}