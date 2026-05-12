<?php
//  if($_SERVER["REQUEST_METHOD"]== 'POST'){
//     echo "POST METHOD";
//  }else{
//     echo "GET METHOD";
//  }

if(isset($_POST["submit"])){
    $name =  $_POST["name"];
    $email=  $_POST["email"];
    $reg_user = '/^[a-zA-Z@]{4,8}$/';
    $reg_email = '/^[a-zA-Z0-9._]{3,30}[@]{1}[a-zA-Z0-9-]{2,20}[.]{1}[a-zA-Z]{2,6}$/';
   

    if(preg_match($reg_email, $email) == false){
        $email_error=  "Email is not valid";
    }else{
        $email_error = "";
    }
 
    if( $email_error == ""){
        $msg =  "Form Submitted successfully";
    }

}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .error-text{
            color:red;
        }
    </style>
</head>
<body>

<form method= "POST">
    <label > UserName</label> <br>
    <input type="text" name="name" id="" value="Safi hasan"> <br>
    <div class="error-text"></div> <br>

    <label for="">Email</label> <br>
    <input type="text" name="email" value="<?php echo $email ?? "safihasan@gmail.com";?>"><br> <br>
    <div class="error-text"><?=$email_error ?? "";?></div> <br>

    <input type="submit" name="submit" value="submit"> <br>
    <h3 style="color:green;"><?php echo $msg?? "";?></h3>
    


</form>
   
</body>
</html>