<?php

$file = fopen("test.txt", "a+");
fwrite($file, "Helllo World  \n");
// fwrite($file, "Hello World ISBD");
fclose($file);

// $file = fopen("test.txt", "r+");
// echo fgets($file);
// fwrite($file, "Hello World ISBD");
// fclose($file);
?>