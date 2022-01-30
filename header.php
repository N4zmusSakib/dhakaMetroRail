<?php
session_start();
require_once('db.php');
// if(isset($_SESSION["msg"])){
//     echo$_SESSION["msg"];
//      $_SESSION["msg"] = "";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhaka Metro Rail</title>
    <style>
        body{
            background-color: #edfad2;
            /* background-image: url('resources/Metro-Rail-2002211346.jpg'); */
        }
        .input_field{
            border: 1px solid;
            background-color: #AED75B;
            width: auto;
            margin: auto;
            padding: 5px 40px;
            border-radius: 5px;
        }
        .input_field input,.input_field textarea,
        .input_field select, .input_field option {
            width: auto;
            padding: 3px 5px;
            margin: 8px 0px;
            display: inline-block;
            border: 1px solid ;
            border-radius: 4px;
            box-sizing: border-box;
            }
            .row_select{
            width: unset;
            margin: 0px 10px;
            border: 3px ;
            background-color: greenyellow;
            vertical-align: top;
            /* width: 100px; */
        }
        .row_select tr, .row_select th, .row_select td{
            vertical-align: top;
            margin: 5px 5px 0;
            padding: 5px 5px 0;
            border: 3px solid;
            /* text-align: left; */
        }
        .row_select input[type=submit]{
            all: unset;
            cursor: pointer;

        }
        .row_select input[type=submit]:hover{
            color: tomato;
        }
    </style>
</head>
<body>
    <!-- head baar -->
    <table style="width: 100%; background-image: url('resources/Metro-Rail-2002211346.jpg');" >
        <tr>
            <td><h2><a style="all:unset; cursor:pointer" href="index.php">Dhaka Metro Rail</a></h2></td>
            <?php
            if(isset($_SESSION["isLogin"])){
                
                echo '<td><a href="ticketDetails.php">Your Ticket</a>';
                if(isset($_SESSION['isAdmin'])){
                    echo '<br> <a href="admin.php">Admin</a>';
                }
                echo '</td>';
                echo '<td><a href="profile.php"> Profile</a> <br> <a href="logout.php">Logout</a> </td>';
            }
            else
                echo '<td><a href="login.php"> Login</a> <br> <a href="register.php"> Register</a></td>';
            ?>
        </tr>
    </table>
    <table>

</body>
</html>
<?php
if(isset($_SESSION["msg"])){
    echo '<center style=" background-color: coral">';
    echo$_SESSION["msg"];
    echo '</center>';
    $_SESSION["msg"] = "";
}
?>