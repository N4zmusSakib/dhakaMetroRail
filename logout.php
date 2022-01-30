<?php
require_once('header.php');
if(!isset($_SESSION["isLogin"])){
    $_SESSION['msg'] = 'You have to login first';
    header('location: login.php');
}
if(isset($_COOKIE['id']) && isset($_COOKIE['pass'])){
    unset($_COOKIE['id']);
    setcookie('id',null,time(),'/');
    unset($_COOKIE['pass']);
    setcookie('pass',null,time(),'/');
}
session_unset();
session_destroy();
header('location: index.php');

?>