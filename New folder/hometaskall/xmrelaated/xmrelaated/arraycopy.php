<?php

$arr =[
    "Japan" =>"Tokio",
    "America" => "New Work",
    "England" => "London",
    "Bangladesh"=>"Dhaka",
    "Pakistan" => "Islamabad",
];

echo "Main Array <br>";
echo ".........<br>";

foreach($arr as $k => $val){
    echo "$k => $val <br>";
}

ksort($arr);

echo " <br>Sorted Array <br>";
echo ".........<br>";

foreach($arr as $k => $val){
    echo "$k => $val <br>";
}




?>