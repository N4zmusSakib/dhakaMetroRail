<?php
require_once('header.php');
require_once('regex.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
$totalValidInput = 0;
if(isset($_POST['submit'])){
    if(!empty($_POST['value1'])){
        $id =  test_input($_POST["value1"]);
        $totalValidInput++; 
    }
    if(!empty($_POST['password'])){
        $passworrd = test_input($_POST['password']);
        $totalValidInput++;
    }
    $remember = 0;
    if(!empty($_POST['remember'])){
    $remember =  $_POST['remember'];
    }

    if($totalValidInput == 2)
    {
        $flagEmail = 'email';
        if(regexUserMobile($id, 0)){
            $flagEmail = 'mobile';
        }
        $rows =  getDataDB('users');
        foreach($rows as $row) {
            $idDB = $row[$flagEmail];
            // echo $idDB , $id;
            $pass = $row['password'];
            if($id == $idDB){
                if($passworrd == $pass)
                {
                    if($remember == 1){
                        setcookie('id',$id,time()+60*60*72);//for 72 hours
                        setcookie('pass',$pass,time()+60*60*72);//for 72 hours
                    }
                    $_SESSION['isLogin'] = 1;
                    $_SESSION['userId'] = $row['idNo'];
                    $_SESSION['userName'] = $row['userName'];
                    $_SESSION['bankID'] = $row['bankID'];
                    echo $_SESSION['bankID'];
                    if($row['userT'] == 'admin')
                        $_SESSION['isAdmin'] = 1;
                    updateDB('users',array('lastLogin'), array($_SERVER["REQUEST_TIME"]), array('idNo',$row['idNo']));
                    $_SESSION["msg"] = '<h4 style="color:green">Login Successful '.$row['userName'].'.</h4>'; 
                    header("location:index.php");
                }
                else
                {
                    $_SESSION["msg"] = '<h4 style="color:red">Invalid Input</h4>'; 
                    header("location:login.php");
                }
            }
        } 
    }
}
?>

<body>
    <form action="login.php" method="POST">
        <table class="input_field">
        <caption><h2>Login</h2></caption>
            <tr>
                <td>Email Or Phone</td>
            </tr>
            <tr>
                <td><input required type="text" name="value1" placeholder="Enter email or phone no"
                value="<?php if(isset($_COOKIE['id'])) echo $_COOKIE['id']; ?> "></td>
            </tr>

            <tr>
                <td>Password</td>
            </tr>
            <tr>
                <td><input required type="password" name="password" placeholder="Password"
                value="<?php if(isset($_COOKIE['pass'])) echo $_COOKIE['pass']; ?>"></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="remember" value="1"> Remember Me</td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="Login">
                <a href="register.php">Not Registered?</a>
            </tr>
        </table>

    </form>
</body>
</html>