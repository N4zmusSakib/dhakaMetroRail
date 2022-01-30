<?php
require_once('db.php');
$rows = getDataDB('ticket');

if(isset($_GET['id']) && isset($_GET['pin']) && isset($_GET['select'])){
    $id = $_GET['id'];
    $pin = $_GET['pin'];
    $select = $_GET['select'];

    $flagFound = 0;
    foreach($rows as $row) {
        if($row['ticketId'] == $id){
            $pin = $row['pin'];
            $valid = $row['valid'];
            $flagFound = 1;
            if($valid == 'yes' && $select =='in'){
                updateDB('ticket', array('valid'),array('in') ,array('ticketId',$id));
                $val = array('in');
                echo json_encode($val);
            }
            else if(($valid == 'yes' || $valid == 'in') && $select =='out'){
                updateDB('ticket', array('valid'),array('out') ,array('ticketId',$id));
                $val = array('out');
                echo json_encode($val);
            }
            else {
                $val = array('notValid');
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

?>