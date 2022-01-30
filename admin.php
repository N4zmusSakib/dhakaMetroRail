<?php
require_once('header.php');
require_once('html_string.php');
require_once('regex.php');
if(!isset($_SESSION['isAdmin'])){
    header('location:index.php');
}
if(!isset($_SESSION['isLogin'])){
    $_SESSION['msg'] = 'You have to Login First';
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .button1 {
    background-color: #a0e612;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 10px 0 0 0;
    cursor: pointer;
}
.button1:hover{
    background-color: #4f7500;
}
    </style>
</head>

<body>
<center><a class="button1" href="view_train_details.php">Train Details</a></center>
<center><a class="button1" href="train_details.php">Add new Train or Station</a></center>
<center><a class="button1" href="view_ticket_info_admin.php">Ticket Details</a></center>
<center><a class="button1" href="view_users.php">view Users</a></center>
</body>
</html>
