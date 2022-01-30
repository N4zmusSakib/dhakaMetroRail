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
    </style>
</head>

<body>
    <?php
    if(isset($_POST['submit'])){
        $lineName = $_POST['lineName'];
        $id = $_POST['idNo'];
        deleteDB($lineName, array('idNo',$id));
    }
    if(isset($_POST['submit2'])){
        $lineName = $_POST['lineName'];
        $id = $_POST['idNo'];
        // echo $id, $lineName;
        deleteDB('line', array('idNo',$id));
        deleteDB($lineName);
    }
    ?>

    <?php
    $rows = getDataDB('line');
    echo '<center><h2>Ticket Details</h2></center>';
    foreach($rows as $row) {
        echo '<form method="POST">';
        echo '<table class="input_field">';
        echo "<tr><td> Line Name: </td><td>".$row['lineName']."</td>";
        echo "<tr><td> First Station: </td><td>".$row['firstStation']."</td>";
        echo "<tr><td> Creation Time: </td><td>".date('d-M-Y',$row['timeStamp']).'</td>';
        echo '<tr><td colspan ="2">';
        echo ' <input type="hidden" name = "lineName" value="'.$row['lineName'].'">';
        echo ' <input type="hidden" name = "idNo" value="'.$row['idNo'].'">';
        echo '<center> <input type="submit" name = "submit2" value="Remove"> </center>';
        echo '</td></tr></table>';
        echo '</form>';
        $rows2 =getDataDB($row['lineName']);
        if($rows2){
            echo '<form method="POST">';
            echo '<table class="input_field" style="background-color:#dbff91;">';
        }
        foreach($rows2 as $row2){
            echo "<tr><td> Station Name: </td><td>".$row2['stationName']."</td>";
            echo "<td> Distance from first station: </td><td>".$row2['distance'];
            echo ' <input type="hidden" name = "lineName" value="'.$row['lineName'].'">';
            echo ' <input type="hidden" name = "idNo" value="'.$row2['idNo'].'">';
            echo ' <input type="submit" name = "submit" value="Remove">';
            echo"</td></tr>";
        }
        if($rows2)
            echo '</table><br>';
            echo '</form>';
    }
    ?>
</body>
</html>





