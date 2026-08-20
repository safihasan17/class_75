<?php

//local

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pos');

//hosting
// define('DB_HOST', 'your-host');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'ecom');


$db= new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if($db->connect_error){
    die("conection Failed:" . $db->connect_error);
}

// else{
//     echo "connect Sucessfully";
// }
?>