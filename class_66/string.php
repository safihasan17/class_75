<?php
     
 $str = "Hello world!";
 echo substr($str,7, 4);

 echo "<br>";
 echo strlen($str);
 echo "<br>";
 echo (strpos($str, 'w'));
 echo "<br>";
 var_dump(strpos($str, 'a'));

 echo "<br>";
 var_dump(stripos($str, 'h'));

  echo "<br>";
  echo strtolower($str);
  echo "<br>";
  echo strtoupper($str);

   echo "<br>";

  $html = htmlspecialchars("<h1 style='font-size: 2000px'>Hello</h1>");
  echo $html;
  echo "<br>";









?>