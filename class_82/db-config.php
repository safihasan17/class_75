<?php
  // new mysqli(host, username, password, database);

  new mysqli("localhost", "root", "", "round_70");

  //local
  // define("DB_HOST", "locahost");
//   define ("DB_USER", "root");
//   define ("DB_PASS", "");
//   define("DB_NAME", "round_70");


$db = new mysqli("localhost", "root", "", "round_70");

if($db->connect_error){
    die("connection failed:" . $db->connect_error);
}
// else{
//     echo "connected successfully";
// }





?>