<?php
require_once('header.php');
require_once('html_string.php');
require_once('regex.php');
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
        .view table, .view th, .view td{
            border:1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>

<body>

<?php


?>
<form method="post">
            <?php
            $rows = getDataDB('ticket','',array('userID',$_SESSION['userId']));
            if($rows){
                echo '<table class="input_field view"><caption><h2>Ticket Details</h2></caption>';
                echo '<tr><th>Ticket Id</th><th>Line Name</th><th>Starting Station</th><th>End Station</th><th>Total Person(s)</th><th>Pin</th><th>Status</th><th>Action</th></tr>';
            }
            foreach($rows as $row) {
                if($row['valid']== 'yes' || $row['valid']== 'in'){
                    $tId = $row['ticketId'];
                    if(isset($_POST[$tId])){
                        deleteDB('ticket',array('ticketId',$tId));
                        continue;
                    }
                    echo "<tr><td> ".$row['ticketId']."</td>";
                    echo "<td> ".$row['lineName']."</td>";
                    echo "<td>".$row['startStation']."</td>";
                    echo "<td>".$row['endStation']."</td>";
                    echo "<td>".$row['totalPerson']."</td>";
                    echo "<td>".$row['pin']."</td>";
                    if($row['valid']== 'yes'){
                        echo "<td>Valid</td>";
                    }
                    else if($row['valid']== 'in'){
                        echo "<td>Inside Train or Station</td>";
                    }
                    if($row['valid']== 'in'){
                        echo "<td>Can not delete now</td>";
                        // echo '<td><input type="submit" name="'.$row['ticketId'].'" value="Delete" readonly></td></tr>';
                    }
                    else
                        echo '<td><input type="submit" name="'.$row['ticketId'].'" value="Delete"></td></tr>';
                }
            }
            if($rows){
                echo '</table>';
            }
            else{
                echo '<center><h1>You have no valid tickets<h1></center>';
            }
            ?>  
            </form>
</body>
</html>



