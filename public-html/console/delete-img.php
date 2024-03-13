<?php  
include 'verifyAdmin.php';
if(isset($_GET['img'])){
    unlink($_GET['img']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>