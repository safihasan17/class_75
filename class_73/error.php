<?php

// try{
//     if(isset($_GET["name"])){
//         echo $_GET["name"];
//     }else{
//         throw new Exception("name is set");
//     }
   
// }catch(Exception $e){
//     echo "<pre>";
//     print_r($e);
//     echo "</pre>";
//     // echo $e-> getMessage();
// }finally{
//     echo "<br> Finally";
// }


error_reporting(E_ALL);
// error_reporting(E_WARNING | E_NOTICE | E_PARSE);
ini_set("display_errors" , 0);
ini_set("log_errors", 1);
ini_set('error_log','error.log');

echo $user;

?>