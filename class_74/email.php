<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="send-mail.php" method= "POST">

    <label for="">Email</label> <br>
    <input type="text" name="email" id=""> <br> <br>
    <label for="">Subject</label> <br>
    <input type="text" name="subject" id=""> <br> <br>
    <label for="">Message</label> <br>
    <textarea name="msg" id=""></textarea> <br> <br>

    <input type="submit" name="mail" id=""  value="send-mail">

    <h3 style= "color:green;"> <?php echo $_GET['msg'] ?? "" ;?></h3>
    </form>
</body>
</html>