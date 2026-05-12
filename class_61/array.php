<?php

   $arr = ["1", "2", "123",true, [1,2,3] ];
   $arr2 = array("a","b","c","d","e","f");

   echo "<pre>";
   print_r($arr);
   print_r($arr2);
  
   echo "</pre>";

  echo count($arr);
  echo "<br>";
  echo count($arr2);
  echo "<br>";

  echo $arr2[2];
  echo "<br>";
  echo $arr[2][0];
?>