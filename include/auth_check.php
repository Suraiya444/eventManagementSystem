<?php
    session_start();
    if(isset($_SESSION['loggin']) && $_SESSION['loggin']){

    }else{
        header('location:login.php');
    }
?>