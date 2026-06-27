<?php
$arr = [
    "Enagland" => "London",
    "Banglasesh" => "Dhaka",
    "Japan" => "Tokio",
    "America" => "Washington DC",
    "India" => "Dhelli"
];


echo "Main array  <br>";
echo  "............<br>";

foreach($arr as $name => $value){
    echo "$name => $value  <br>";
}

ksort($arr);
echo "<br>";

echo "sorted Array <br>";
echo  "............<br>";

foreach($arr as $name => $value){
    echo "$name => $value  <br>";
}


?>