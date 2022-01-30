<?php
require_once('header.php');
require_once('html_string.php');
if(!isset($_SESSION['isAdmin'])){
    header('location:index.php');
}
?>
</table>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         /* table, tr ,td {
            width: 100%;
            border: 1px dotted black;
            ali: top;
        }  */
        

    </style>
</head>

<body>

        <table style="width: 100%;">
            <tr style="vertical-align: top">
                <td>
                    <table class="row_select">
                    <form method="GET">
                        <tr>
                            <th> <input type="submit" name="addLineFrom" value="Add New Line"></th>
                        </tr>
                        <tr>
                        <th> <input type="submit" name="addNewStationFrom" value="Add New Station"></th>
                        </tr>
                        <tr>
                            <!-- <th> Add Line</th> -->
                        </tr>
                    </form>
                    </table>
                </td>
                <td>
                    <?php
                    // for add line
                    if(isset($_GET['addLineFrom'])){
                        echo getAddlineInfo();
                    }
                    if(isset($_POST['addNewLine'])){
                        // echo getAddlineInfo();
                        $flag =insertDB('line',array('lineName', 'firstStation', 'discription'), array($_POST["name"],$_POST["firstStation"],$_POST["discription"]));
                        if($flag){
                              createLineTable($_POST["name"]);
                              insertDB($_POST["name"],array("stationName","distance"),array($_POST["firstStation"],0));
                            $_SESSION["msg"] = '<h4 style="color:green">Successfully Inserted</h4>'; 
                        }
                        else{
                            $_SESSION["msg"] = '<h4 style="color:red">unsuccessfully Inserted</h4>';
                        }
                        header("location:train_details.php?addLineFrom=Add+New+Line");
                    }
                    ///addNewStationFrom
                    if(isset($_GET['addNewStationFrom'])){
                        // $rows = getDataDB('line');
                        echo getSelectLineInfo();
                    }
                    if(isset($_GET['addNewStationFrom2'])){
                        echo getSelectLineInfo() . "<br>";
                        $lineName = $_GET["selectLineName"];
                        $rows = getDataDB('line');
                        foreach($rows as $row) {
                            $val1 = $row['lineName'];
                            $val2 = $row['firstStation'];
                            if($val1 == $lineName){
                            break;
                            }
                        }
                        echo '<table class="input_field">
                    <form method="get">
                        <input type="hidden" name="lineName" value="'. $val1 .'">
                    <tr>
                        <td>New Station Name</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="newStation" placeholder="e.g. Uttora Center" required></td>
                    </tr>
                    <tr>
                        <td>Distance from <em><strong> '. $val2 . '</strong></em> (in k.m)</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="distance" placeholder="3" required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="addNewStationFrom3" value="Submit"></td>
                    </tr>
                    </form>
                    </table>';

                    }
                    if(isset($_GET['addNewStationFrom3'])){
                        $lineName = $_GET["lineName"];
                        $newStation = $_GET["newStation"];
                        $distance = $_GET["distance"];
                        // echo $lineName, $newStation, $distance;
                        $flag = insertDB($lineName,array("stationName","distance"),array($newStation,$distance));
                        if($flag){
                            $_SESSION["msg"] = '<h4 style="color:green">Successfully Inserted</h4>'; 
                        }
                        else{
                            $_SESSION["msg"] = '<h4 style="color:red">unsuccessfully Inserted</h4>';
                        }
                        header("location:train_details.php?addNewStationFrom=Add+New+Station");

                    }
                    
                    ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>



