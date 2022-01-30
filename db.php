<?php
function coonectDB(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
    $conn = new PDO("mysql:host=$servername;dbname=dhakametroraildb", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    } catch(PDOException $e) {
    // echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
function disconnectDB($conn){
    $conn = NULL;
}
function insertDB($tableName, $columnNames, $values){
    $sql = "INSERT INTO " . $tableName . "(";

    for($i=0; $i<count($columnNames); $i++){
        $sql .= $columnNames[$i]. ",";
    }
    $sql .= "timeStamp ) values (";
    for($i=0; $i<count($values); $i++){
        $sql .= "'" .$values[$i] ."'".",";
    }
    $sql .= time(). ");";
    //  echo $sql;
    $conn = coonectDB();
    if($conn->query($sql) == TRUE){
        disconnectDB($conn);
        return TRUE;
    }
    else{
        disconnectDB($conn);
        return FALSE;
    }
}
function getDataDB($tableName, $orderBy="", $where=""){
    $sql = "SELECT * FROM ". $tableName ." ";
    if($where)
        $sql .= "Where " .$where[0]." = "."'". $where[1] ."'";
    if($orderBy)
        $sql .= " ORDER BY $orderBy";
    $sql.= ';';
    // echo $sql;
    $conn = coonectDB();
    $result = $conn->query($sql);
    $rows = $result->fetchAll();
    disconnectDB($conn);
    // print_r($rows);
    // foreach($rows as $row) {

    // }
    return $rows;
}

function updateDB($tableName, $columnNames, $values, $where=""){
    $sql = "UPDATE $tableName SET ";
    for($i=0; $i<count($columnNames); $i++){
        if($i>0)
            $sql .= ',';
            $sql .= $columnNames[$i]. " = '". $values[$i] ."' ";
        }
    if($where)
        $sql .= "Where " .$where[0]." = "."'". $where[1] ."'";
        
    $sql .= ';';
    // echo $sql;
    $conn = coonectDB();
    $conn->exec($sql);
    disconnectDB($conn);
}
function deleteDB($tableName, $where=""){
    $sql = "DELETE FROM $tableName ";
    if($where)
        $sql .= "Where " .$where[0]." = "."'". $where[1] ."'";    
    $sql .= ';';
    // echo $sql;
    $conn = coonectDB();
    $conn->exec($sql);
    disconnectDB($conn);
}

function createLineTable($lineName){
    $sql = 'CREATE TABLE IF NOT EXISTS '. $lineName .' (
        idNo int NOT NULL AUTO_INCREMENT,
        stationName varchar(55),
        distance varchar(55),
        timeStamp varchar(55),
        PRIMARY KEY (idNo)
    );';
    $conn = coonectDB();
    $conn->exec($sql);
    disconnectDB($conn);
}

?>
