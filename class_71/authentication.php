<?php
$pass= "123";
 $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
 echo  $hashed_pass;
 echo "<br>";
//  echo password_hash("Password", PASSWORD_DEFAULT);


if(password_verify($pass, $hashed_pass)){
    echo "password is valid";
}else{
    echo "password is not valid";
}
?>