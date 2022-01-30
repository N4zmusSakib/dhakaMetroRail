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
                            <th> <input type="submit" name="viewProfile" value="View Profile"></th>
                        </tr>
                        <tr>
                            <th> <input type="submit" name="editInfo" value="Edit Info"></th>
                        </tr>
                        <tr>
                            <th> <input type="submit" name="changePassword" value="Change Password"></th>
                        </tr>
                    </form>
                    </table>
                </td>
                <td>
                    <?php
                    if(isset($_GET['viewProfile'])){
                        echo getViewProfileInfo();
                    }
                    //edit info
                    if(isset($_GET['editInfo'])){
                        $total_valid_input = 0;
                        $passwordErr = $cpasswordErr = $nameErr = $emailErr = $mobileErr = "";
                        $nameIn = $nIDIn = $bankIDIn = "";
                        if(isset($_POST['updateInfo'])){
                            if(!empty($_POST['name'])){
                                $nameIn =  test_input($_POST["name"]);
                                if(regexUserName($nameIn)){
                                  $total_valid_input++;
                                }
                                else{
                                  $nameErr = "not a valid name";
                                }
                              }
                              if(!empty($_POST['nID'])){
                                  $nIDIn = test_input($_POST['nID']);
                              }
                              if(!empty($_POST['bankID'])){
                                  $bankIDIn = test_input($_POST['bankID']);
                              }
                        }
                        if($total_valid_input == 1){
                            // echo "in";
                            $col = array('userName', 'nID', 'BankID');
                            $val = array($nameIn, $nIDIn, $bankIDIn);
                            updateDB('users',$col,$val,array('idNo', $_SESSION['userId']));
                            $_SESSION['bankID'] =  $bankIDIn;
                            $_SESSION['msg'] = 'Updated';
                            // echo $_SESSION['bankID'];
                            header('locatiol:http://localhost/dhakaMetroRail/profile.php?editInfo=Edit+Info');
                        }
                        $rows = getDataDB("users", "", array('idNo', $_SESSION['userId']));
                        foreach($rows as $row) {
                            $name = $row['userName'];
                            $email = $row['email'];
                            $mobile = $row['mobile'];
                            $join = $row['timeStamp'];
                            $nID = $row['nID'];
                            $bankID = $row['bankID'];
                            $_SESSION['bankID'] = $row['bankID'];
                        }
                    $profile ='<form method="POST">
                    <table class="input_field">
                        <caption><h2>Edit Info</h2></caption>
                        <tr>
                            <td>Name</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="name" value="'.$name.'" >'. " $nameErr" .'</td>
                        </tr>

                        <tr>
                            <td>Email Address</td>
                        </tr>
                        <tr>
                            <td><input type="email" name="email" value="'.$email.'" readonly></td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="mobile" value="'.$mobile.'" readonly></td>
                        </tr>
                        <tr>
                            <td>NID</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="nID" value="'.$nID.'" ></td>
                        </tr>
                        <tr>
                            <td>ABC Bank ID</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="bankID" value="'.$bankID.'" ></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="updateInfo" value="Update">
                        </tr>
                    </table>

                </form>';
                    echo $profile;
                    }
                    //cnange Password
                    
                    if(isset($_GET['changePassword'])){
                        $cpasswordErr =  $passwordErr = $oldPasswordErr = "";
                        $total_valid_input = 0;
                    if(isset($_POST['updatePassword'])){
                        if(!empty($_POST['oldPassword'])){
                            $oldPassword =  test_input($_POST['oldPassword']);
                            
                            if(regexUserPassword($oldPassword)){
                                $total_valid_input++;
                                }
                                else{
                                $oldPasswordErr = "input alphanumeric and at least 8 characters";
                                }
                        }
                        
                        if(!empty($_POST['password'])){
                            $passwoed =  test_input($_POST["password"]);
                            if(regexUserPassword($passwoed)){
                            $total_valid_input++;
                            }
                            else{
                            $passwordErr = "input alphanumeric and at least 8 characters";
                            }
                        }
                        //cpass
                        if(!empty($_POST['confirmPassword'])){
                            $confirmPassword =  test_input($_POST["confirmPassword"]);
                            if(regexUserPassword($confirmPassword)){
                            $total_valid_input++;
                            }
                            else{
                            $cpasswordErr = "not valid password";
                            }
                        }
                        if($total_valid_input == 3 && $passwoed != $confirmPassword)
                        {
                            $cpasswordErr = "password does not match";
                        }
                        else if($total_valid_input == 3)
                        {
                            $rows = getDataDB('users','',array('idNo',$_SESSION['userId']));
                            foreach($rows as $row) {
                                $val1 = $row['password'];
                                if($val1 == $oldPassword){
                                    updateDB('users',array('password'),array($passwoed), array('idNo',$_SESSION['userId']));
                                }
                            }
                        }
                    }
                        $rows = getDataDB("users", "",array('idNo', $_SESSION['userId']));
                        foreach($rows as $row) {
                            $PassDB = $row['password'];
                            // echo $PassDB;
                        }
                        $profile ='<form method="POST">
                        <table class="input_field">
                        <caption><h2>Change Password</h2></caption>
                        <tr>
                            <td>Old Password</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="oldPassword" placeholder="Password" >'.$oldPasswordErr.'</td>
                        </tr>
                        <tr>
                            <td>New Password</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" placeholder="new Password" >'.$passwordErr.'</td>
                        </tr>
                        <tr>
                            <td>Confirm new Password</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="confirmPassword" placeholder="Re-type password" >'. $cpasswordErr.'</td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="updatePassword" value="Update">
                        </tr>
                        </table>
                        </form>';
                echo $profile;
                    }
                    
                    ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>



