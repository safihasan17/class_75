<?php

$arr = [
    "a"=> "Apple",
    "b"=> "ball",
    "c"=> "cat",
    "d"=> "Dog",
    "e"=> "Fish",

];

echo "<pre>";
print_r(array_flip($arr));
echo "</pre>";

$arr2 = ["apple","B0a
ll","cat", "Dog","Fish",];
echo "<pre>";
print_r(array_reverse($arr2));
echo "</pre>";
?>