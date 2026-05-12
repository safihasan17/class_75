<?php

$arr = ["Mina","Keya","kamal","Apple", "Rita","zuyel"];

$arr_num =[101,2,4,150,1010,660];

echo "<pre>";
print_r($arr);
echo "</pre>";

sort($arr);
echo "<pre>";
print_r($arr);
echo "</pre>";

rsort($arr);
echo "<pre>";
print_r($arr);
echo "</pre>";


sort($arr_num);
echo "<pre>";
print_r($arr_num);
echo "</pre>";

rsort($arr_num);
echo "<pre>";
print_r($arr_num);
echo "</pre>";



$arr_asso =[
    "Bangladesh" => "Dhaka",
    "Usa"        => "Newyork",
    "Uk"         => "London",
    "Pakistan"   => "Islamabad",
];



echo "<pre>";
print_r($arr_asso);
echo "</pre>";

asort($arr_asso);
echo "<pre>";
print_r($arr_asso);
echo "</pre>";

arsort($arr_asso);  
echo "<pre>";
print_r($arr_asso);
echo "</pre>";


// rsort($arr_asso);   //neumaric array niye kaj kore
// echo "<pre>";
// print_r($arr_asso);
// echo "</pre>";


ksort($arr_asso);
echo "<pre>";
print_r($arr_asso);
echo "</pre>";

krsort($arr_asso);
echo "<pre>";
print_r($arr_asso);
echo "</pre>";















?>