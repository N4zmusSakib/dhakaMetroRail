<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_POST['submit'])){
        $url = 'http://localhost/dhakaMetroRail/ticket_check_api.php?id='.$_POST["tId"] .'&pin='.$_POST["pin"].'&select='.$_POST["pos"];
        // echo $url;
        $json = file_get_contents($url);
        $jsonArr = json_decode($json, true);
        print_r($jsonArr);
    }
    ?>
    <form method="post">
        Select 
        <select name="pos">
            <option value="in">Entry</option>
            <option value="out">Exit</option>
        </select>
        <br>
         Ticket ID
        <input type="text" name="tId">
        <br>
         Pin
        <input type="text" name="pin"><br>
        <input type="submit" name="submit" value="Submit">

    </form>
</body>
</html>