<?php

$str = "Hello World 2026";
$arr = explode(" ", $str);

echo "<pre>";
print_r($arr);
echo "</pre>";

$newstr = implode(":", $arr);
echo $newstr;

$arr2 = range(5,50, 10);
echo "<pre>";
print_r($arr2);
echo "</pre>";

$arr3 = range("a","t",3);
echo "<pre>";
print_r($arr3);
echo "</pre>";


$arr_assoc = [
    "a"=>"Apple",
    "b"=>"Ball",

];

echo array_key_exists("d",$arr_assoc) ? "Found": "Not found";

$keys = array_keys($arr_assoc);
echo "<pre>";
print_r($keys);
echo "</pre>";

$values = array_values($arr_assoc);
echo "<pre>";
print_r($values);
echo "</pre>";


?>
