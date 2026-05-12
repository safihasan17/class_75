<?php

$arr = ["Apple", "Pencil", "Ball", "Gun"];

echo "<pre>";
print_r ($arr);
echo "</pre>";

usort($arr, function($a, $b){
    return strlen($a) - strlen($b);
});

echo "<pre>";
print_r ($arr);
echo "</pre>";


usort($arr, function($a, $b){
    return strlen($b) - strlen($a);
});

echo "<pre>";
print_r ($arr);
echo "</pre>";

?>