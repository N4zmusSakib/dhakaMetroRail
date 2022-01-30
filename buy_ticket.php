<?php
require_once('header.php');
require_once('regex.php');
$valueOfSubmit = 'Select';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="buy_ticket.php" method="POST">
        <table class="input_field"style="text-align:center">
        <caption><h2>Buy Ticket</h2></caption>
            <tr>
                <td colspan="2">Select Line Name</td>
            </tr>
            <tr>
                <td colspan="2"><select type="text" name="selectLineName">
                    <?php
                    if(!empty($_POST['selectLineName'])){
                        $lineName = $_POST['selectLineName'];
                        $_SESSION['lineNameFromBuyTicket'] = $lineName;
                    }
                    if(!empty($_POST['stationFrom']) && !empty($_POST['stationTo'])){
                        $stationFrom = $_POST['stationFrom'];
                        $stationTo = $_POST['stationTo'];
                        $_SESSION['stationFromFromBuyTicket'] = $stationFrom;
                        $_SESSION['stationToFromBuyTicket'] = $stationTo;
                    }


                    $rows = getDataDB("line");
                    foreach($rows as $row) {
                        $val =$row['lineName'];
                        if(isset($_SESSION['lineNameFromBuyTicket']) && $val == $_SESSION['lineNameFromBuyTicket'])
                            echo "<option value=\"$val\" selected >$val</option>";
                        else
                            echo "<option value=\"$val\" >$val</option>";
                    }
                    ?>
                    </select></td>
            </tr>
            
                    <?php
                    if(!empty($_POST['selectLineName'])){

                        echo '<tr><th>From</th> <th>To</th></tr>';
                        echo '<tr> <td><select type="text" name="stationFrom">';
                        $rows = getDataDB("$lineName");
                        foreach($rows as $row) {
                        $val =$row['stationName'];
                        if(isset($_SESSION['stationFromFromBuyTicket']) && $val ==  $_SESSION['stationFromFromBuyTicket'])
                            echo "<option value=\"$val\" selected >$val</option>";
                        else
                            echo "<option value=\"$val\" >$val</option>";
                        }
                    echo '</select></td>';
                    echo ' <td><select type="text" name="stationTo">';
                        // $rows = getDataDB("mrt_line_6");
                        foreach($rows as $row) {
                            $val =$row['stationName'];
                            if(isset($_SESSION['stationToFromBuyTicket']) && $val == $_SESSION['stationToFromBuyTicket'])
                                echo "<option value=\"$val\" selected >$val</option>";
                            else
                              echo "<option value=\"$val\" >$val</option>";
                            }
                    echo '</select></td></tr>';
                    }
                    ?>
                    <?php
                    if(!empty($_POST['stationFrom']) && !empty($_POST['stationTo'])){
                        $stationFrom = $_POST['stationFrom'];
                        $stationTo = $_POST['stationTo'];
                        foreach($rows as $row) {
                            $val =$row['stationName'];
                            $dist = $row['distance'];
                            if($val == $stationFrom){
                                // echo $dist;
                                $distanceFrom = $dist;
                            }
                            if($val == $stationTo){
                                $distanceTo = $dist;
                            }
                        }

                        ///Passengers
                        if(isset($_POST['numberOfTicket']))
                        {
                            $_SESSION['numberOfTicket'] = $_POST['numberOfTicket']; 
                        }
                        echo '<tr><td colspan="2">Passenger(s) </td></tr>';
                        echo ' <td colspan = "2"><select type="text" name="numberOfTicket">';
                        for($i=1; $i<=4; $i++)
                        {
                            if(isset($_SESSION['numberOfTicket']) && $_SESSION['numberOfTicket'] == $i)
                                echo '<option value="'.$i.'"selected ">'.$i.' </option>';
                            else
                                echo '<option value="'.$i.'">'.$i.' </option>';
                        }
                    
                       
                        // echo $valueOfSubmit;
                        // $valueOfSubmit = "Confirm";
                        if(isset($_POST['buyingStatus']))
                            $_SESSION['buyingStatus'] = $_POST['buyingStatus'];
                        if(isset($_POST['numberOfTicket'])){
                            echo '</select>';
                            $distance = abs($distanceFrom - $distanceTo);
                            echo '<tr><td colspan ="2">Distance '. $distance .' K.m.</td></tr>';
                            $totalAmount = $distance*$_SESSION['numberOfTicket']*3;
                            echo '<tr><td colspan ="2">For '.$_SESSION['numberOfTicket'].' Person total cost '. $totalAmount .' Taka</td></tr>';
                            $haveAid = 0;
                            if(isset($_SESSION["bankID"])){
                                $haveAid = 1;
                            }
                            // echo "in";

                                echo ' <td colspan = "2">I want to <select type="text" name="buyingStatus">';
                                    if(isset($_SESSION['buyingStatus']) && $_SESSION['buyingStatus'] == 'buy'){
                                        echo '<option value="buy"selected> Buy </option>';
                                        echo '<option value="notBuy">Not Buy </option>';
                                    }
                                    else{
                                        echo '<option value="buy"> Buy </option>';
                                        echo '<option value="notBuy" selected>Not Buy </option>';
                                    }
                                    echo ' </select> now.</td></tr>';
                                    // echo $_SESSION['bankID'];
                        }
                        if( isset($_POST['buyingStatus']) && $_POST['buyingStatus'] == 'buy')
                        {
                            if(!isset($_SESSION['bankID'])){
                                $_SESSION['msg']= 'Please Enter a valid <a href="http://localhost/dhakaMetroRail/profile.php?editInfo=Edit+Info"> Bank ID</a>';
                                header('location:http://localhost/dhakaMetroRail/profile.php?editInfo=Edit+Info');
                            }
                            $url = 'http://localhost/dhakaMetroRail/abcbank.php?id='.$_SESSION["bankID"];
                            // echo $_SESSION["bankID"];
                            $json = file_get_contents($url);
                            $jsonArr = json_decode($json, true);
                            //  echo $jsonArr[0];
                            if($jsonArr[0] == 'foundDB'){
                                $url = 'http://localhost/dhakaMetroRail/abcbank.php?id='.$_SESSION["bankID"] .'&tk='. $totalAmount;
                                // echo $url;
                                $json = file_get_contents($url);
                                $jsonArr = json_decode($json, true);
                                     print_r($jsonArr);
                                if($jsonArr[0] == 'success'){
                                    echo '<tr><td colspan = "2">Success</td></td>';
                                    $col = array('userID','lineName', 'startStation', 'endStation','totalPerson', 'pin','valid');
                                    $val = array($_SESSION['userId'], $_SESSION['lineNameFromBuyTicket'],
                                                $_SESSION['stationFromFromBuyTicket'],
                                                $_SESSION['stationToFromBuyTicket'],
                                                $_SESSION['numberOfTicket'],rand(11111,99999),'yes');
                                    insertDB('ticket',$col,$val);
                                    $valueOfSubmit = 0;
                                    $_SESSION['msg'] = 'Ticket successfully added';
                                    header('location:ticketDetails.php');
                                }
                                else if($jsonArr[0] == 'notEnoughBalance'){
                                    echo '<tr><td colspan = "2">You have Not enough balance</td></td>';
                                }
                                else{
                                    echo '<tr><td colspan = "2">Please Enter a valid Bank ID</td></td>';
                                }

                            }
                            else{
                                echo '<tr><td colspan = "2">Please Enter a valid <a href="http://localhost/dhakaMetroRail/profile.php?editInfo=Edit+Info"> Bank ID</a></td></td>';
                            }
                        }
                        if( isset($_POST['buyingStatus']) && $_POST['buyingStatus'] == 'notBuy')
                          header('location:index.php');
                    }
                    ?>

            <?php 
            if($valueOfSubmit)
            echo '<tr> <td colspan="2"><input type="submit" name="submit" value="Select"></tr>';
            ?>
        </table>

    </form>
</body>
</html>