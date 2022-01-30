<?php
function getAddlineInfo()
{
    $lineNameHtm ='<table class="input_field">
    <form method="POST">
    <caption><h2>Add New Line</h2></caption>
    <tr>
        <td>Line Name</td>
    </tr>
    <tr>
        <td><input type="text" name="name" placeholder="e.g. MRT_Line_1" value="MRT_Line_6" required></td>
    </tr>
    <tr>
        <td>Starting Station</td>
    </tr>
    <tr>
        <td><input type="text" name="firstStation" placeholder="e.g. Uttora North" required></td>
    </tr>
    <tr>
        <td>Discription</td>
    </tr>
    <tr>
        <td><textarea name="discription" cols="30" rows="10"></textarea></td>
    </tr>
    <tr>
        <td><input type="submit" name="addNewLine" value="Submit"></td>
    </tr>
    </form>
    </table>';
    return $lineNameHtm;
}
function getSelectLineInfo()
{
  $rows = getDataDB("line");
  $selectLineHtm = '<table class="input_field">
                    <form method="get">
                    <caption><h2>Add New Station</h2></caption>
                    <tr>
                        <td>Select Line</td>
                    </tr>
                    <tr>
                        <td>
                            <select type="text" name="selectLineName">';
                                foreach($rows as $row) {
                                $val =$row['lineName'];
                                $selectLineHtm .= "<option value=\"$val\" >$val</option>";
                                }
$selectLineHtm .= '</select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="addNewStationFrom2" value="Submit"></td>
                    </tr>
                    </form>
                    </table>';
                    return $selectLineHtm;
}


function getViewProfileInfo()
{
    $rows = getDataDB("users", "", array('idNo', $_SESSION['userId']));
    foreach($rows as $row) {
        $name = $row['userName'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $join = $row['timeStamp'];
        $nID = $row['nID'];
        $bankID = $row['bankID'];
        }
    $profile ='<table class="input_field">
    <caption><h2>Profile Info</h2></caption>
    <tr>
        <td>Name:</td>
        <td>'.$name.'</td>
    </tr>
    <tr>
        <td>Email:</td>
        <td>'.$email.'</td>
    </tr>
    <tr>
        <td>Mobile:</td>
        <td>'.$mobile.'</td>
    </tr>
    <tr>
        <td>NID:</td>
        <td>'.$nID.'</td>
    </tr>
    <tr>
        <td>ABC Bank ID:</td>
        <td>'.$bankID.'</td>
    </tr>
    <tr>
        <td>Join Date:</td>
        <td>'.Date('d-M-Y', $join).'</td>
    </tr>
    
    </table>';
    return $profile;
}
?>
