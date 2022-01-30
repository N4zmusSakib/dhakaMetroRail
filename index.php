<?php
require_once('header.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhaka Metro Rail</title>
    <style>
.button1 {
    background-color: #a0e612;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 100px 2px;
    cursor: pointer;
    border-radius: 10px;
}
.button1:hover{
    background-color: #4f7500;
}
    </style>
</head>
<body>
<center><a class="button1" href="buy_ticket.php">Buy Ticket</a></center>


<?php
if(isset($_SESSION['userId']))
{
    $id = $_SESSION['userId'];
    $user = getDataDB('ticket','timeStamp DESC',array('userID',$id));
    foreach($user as $row){
        if($row['valid'] == 'out'){
            echo '<center><h2>Your last travel was from '. $row['startStation'] .' to '.$row['endStation'] .'</h2></center>';
            break;
        }
    }

}

?>


</body>
</html>