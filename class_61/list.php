<?php

$arr = ["Mina", 12, true];
list($name , $age,  $is_active) = $arr;

echo $name;
echo "<br>";
echo $age;
echo "<br>";
echo $is_active ?"active": "inactive";

?>
