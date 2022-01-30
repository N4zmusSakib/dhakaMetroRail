<?php
require_once('header.php');
require_once('regex.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* .input_field{
            background-color: greenyellow;
            width: auto;
            margin: auto;
        } */
    </style>
</head>

<?php
  $total_valid_input = 0;
  $passwordErr = $cpasswordErr = $nameErr = $emailErr = $mobileErr = "";
      if(isset($_POST['submit'])){
        //name
        if(!empty($_POST['name'])){
          $name =  test_input($_POST["name"]);
          if(regexUserName($name)){
            $total_valid_input++;
          }
          else{
            $nameErr = "not a valid name";
          }
        }
        //email
        if(!empty($_POST["email"])){
            $email = test_input($_POST["email"]);
            if(regexUserEmail($email)){
              $total_valid_input++;
            }
            else{
              $emailErr = "Invalid email/already registerd";
            }
          }
        //mobile
        if(!empty($_POST["mobile"])){
            $mobile = test_input($_POST["mobile"]);
            if(regexUserMobile($mobile)){
              $total_valid_input++;
            }
            else{
              $mobileErr = "Invalid BD number/already registerd";
            }
          }
        //pass
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
        
        //user type
        if(!empty($_POST["userT"])){
          $userType = test_input($_POST["userT"]);
          $total_valid_input++;
          }
      }
      // echo $total_valid_input;
      if($total_valid_input == 6){
          if($passwoed !== $confirmPassword){
              $cpasswordErr = "Password does not match";
          }
          else{
              $arr1 = array('userName','email', 'mobile' , 'password', 'userT');
              $arr2 = array($name,$email, $mobile, $passwoed,$userType);
              $flag = insertDB('users',$arr1,$arr2);
              if($flag){
                $_SESSION["msg"] = '<h4 style="color:green">Successfully Registered</h4>'; 
                header("location:login.php");
                }
                else{
                    $_SESSION["msg"] = '<h4 style="color:red">Registeration Unccessfull</h4>';
                    header("location:register.php");
                }
          }

      }
  ?>


<body>
    <form action="register.php" method="POST">
        <table class="input_field">
            <caption><h2>Register</h2></caption>
            <tr>
                <td>Name</td>
            </tr>
            <tr>
                <td><input type="text" name="name" placeholder="Full Name" required ><?php echo " ". $nameErr;?></td>
            </tr>

            <tr>
                <td>Email Address</td>
            </tr>
            <tr>
                <td><input type="email" name="email" placeholder="Enter email" required><?php echo " ". $emailErr;?></td>
            </tr>
            <tr>
                <td>Mobile</td>
            </tr>
            <tr>
                <td><input type="text" name="mobile" placeholder="Mobile number"required ><?php echo " ". $mobileErr;?></td>
            </tr>
            <tr>
                <td>Password</td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="Password" required><?php echo " ". $passwordErr;?></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
            </tr>
            <tr>
                <td><input type="password" name="confirmPassword" placeholder="Re-type password" required><?php echo " ". $cpasswordErr;?></td>
            </tr>
            <tr>
                <td>User type <em>[User/Admin]</em></td>
            </tr>
            <tr>
                <td><select name="userT">
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Register">
                <a href="login.php">Already Registered?</a>
            </tr>
        </table>

    </form>
</body>
</html>