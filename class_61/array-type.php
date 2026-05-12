<?php

// numeric /indexed array
// associative array
// multidimentional array
 


// numeric /indexed array
$arr_num = ["a","b",true, 456];
echo "<pre>";
var_dump($arr_num);
echo "</pre>";


// associative array

$arr_asso = [
    "Name" => "johh Doe",
    "age" => "22",
    "email" =>  [
        "e1" => "exaple1@.com",
        "e2" => "exaple2@.com",
    ]
];
$arr_asso ["Name"] = "Safi Hasan";
echo "<pre>";
print_r($arr_asso);
echo "<br>";
echo $arr_asso["email"]["e2"];
echo "<br>";
print_r ($arr_asso["email"]["e1"]);

echo "<br>";
// var_dump($arr_asso);
echo "</pre>";


// multidimentional array

$arr_multi =[
    ["a", "b", "c","d"],
    ["e", "f", "g","h"],
    ["i", "j", "k","l"],

];

echo "<pre>";
print_r($arr_multi);
echo "<br>";
// var_dump($arr_multi);
echo "</pre>";


//new












    



?>