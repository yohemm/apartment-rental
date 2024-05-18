<?php
session_start();
require('redirection.php');
include 'verifyAdmin.php';
// var_dump($_SESSION);

if(isset($_GET['img'])){
    unlink($_GET['img']);
    // echo($_SERVER['HTTP_HOST'].'/console');
    redirect('console/index.php?success=image');
    // header('Location:' . $_SERVER['HTTP_HOST'].'/console/index.php?refresh=true');
}
?>