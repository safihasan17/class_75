<?php

$arr =[
    "Rahim" =>"83",
    "karim" => "78",
    "Mithu" => "92",
    "Raju"=>"65",
    "John" => "68",
];

echo "Main Array: <br>";
echo "..........<br>";

foreach($arr as $k => $val){
    echo "$k => $val  <br>";
}

ksort($arr);
echo " <br>sorted  Array: <br>";
echo "..........<br>";


foreach($arr as $k => $val){
    echo "$k => $val  <br>";
}







?>