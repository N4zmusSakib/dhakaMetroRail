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
.view table {
  width: 100%; 
  margin: auto;
  border-collapse: collapse;
}
.view table, .view td,.view th {
  border: 1px solid black;
   background-color: #e3ffa8;
}

    </style>
</head>

<body>
            <?php
            $rows = getDataDB('users');
            echo '<center><h2>Users Details</h2></center>';
            echo '<table class=" view" style="margin:atuo;">';
            echo' <tr><th>User Name</th><th>Email</th><th>Mobile</th><th>Join Date</th><th>Last Login</th>';
            foreach($rows as $row) {
                echo "<tr><td>".$row['userName']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td> ".$row['mobile']."</td>";
                echo "<td>".date('d-M-Y',$row['timeStamp'])."</td>";
                echo "<td>".date('d-M-Y,h:m',$row['lastLogin'])."</td></tr>";
            }
            echo '</table>';
            ?>
</body>
</html>



