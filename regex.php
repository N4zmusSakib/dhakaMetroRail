<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
function regexUserName($name){
    $rname = '/^[a-zA-Z]+((\s[a-zA-Z]+)+)?$/';
    if(preg_match($rname, $name)){
        return 1;
    }
    return 0;
}

function regexUserEmail($email, $checkDUP = 1){
    $remail = '/^[a-z\d\._-]+@([a-z\d-]+\.)+[a-z]{2,6}$/i';
    if($checkDUP){
        $rows =  getDataDB('users');
        foreach($rows as $row) {
            $val1 = $row['email'];
            if($val1 == $email){
            return 0;
            }
        }
    }
    if(preg_match($remail, $email)){
        return 1;
    }
    return 0;
}

function regexUserMobile($mobile, $checkDUP = 1){
    $rmobile = '/^[+88]?01\d{9}$/';
    if($checkDUP){
        $rows =  getDataDB('users');
        foreach($rows as $row) {
            $val1 = $row['mobile'];
            if($val1 == $mobile){
            return 0;
            }
        }
    }
    if(preg_match($rmobile, $mobile)){
        return 1;
    }
    return 0;
}

function regexUserPassword($pass){
    $rpass = '/^([a-z]|[A-Z]|[0-9]){8,20}$/';
    if(preg_match($rpass, $pass)){
        return 1;
    }
    return 0;
}
function regexLineName($name){
    $rname = '/^mrt_line_\d+$/i';
    if(preg_match($rname, $name)){
        return 1;
    }
    return 0;
}

?>