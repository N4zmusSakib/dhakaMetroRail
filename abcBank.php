<?php
require_once('db.php');
$rows = getDataDB('abcBank');

if(isset($_GET['id']) && isset($_GET['tk'])){
    $id = $_GET['id'];
    $tk = $_GET['tk'];
    $flagFound = 0;
    foreach($rows as $row) {
        if($row['bankID'] == '000'){
            $bankBal = $row['balance'];
        }
    }
    foreach($rows as $row) {
        if($row['bankID'] == '000'){
            $bankBal = $row['balance'];
        }
        if($row['bankID'] == $id){
            // echo $bankBal;
            $bal = $row['balance'];
            $flagFound = 1;
            if($bal >= $tk){
                updateDB('abcBank', array('balance'),array($bal-$tk) ,array('bankID',$id));
                updateDB('abcBank', array('balance'),array($tk+$bankBal) ,array('bankID','000'));
                $val = array('success');
                echo json_encode($val);
            }
            else {
                $val = array('notEnoughBalance');
                echo json_encode($val);
            }
            break;
        }
    }
    if(!$flagFound){
        $val = array('notfoundDB');
        echo json_encode($val);
    }
}
else if(isset($_GET['id'])){
    $id = $_GET['id'];
    $flagFound = 0;
    foreach($rows as $row) {
        if($row['bankID'] == $id)
        {
            $flagFound = 1;
            $val = array('foundDB');
            echo json_encode($val);
            break;
        }
    }
    if(!$flagFound){
        $val = array('notfoundDB');
        echo json_encode($val);
    }
}
else{
    $val = array('unvalidURL');
        echo json_encode($val);
}


?>