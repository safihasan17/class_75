<?php

// $file = fopen("studennt.csv", "a+");
// fputcsv($file,array(3,"Khairul", "70"));
// fclose($file);


$file = fopen("studennt.csv", "r+");
// print_r(fgetcsv($file));
// echo "<br>";
// print_r(fgetcsv($file));
// echo "<br>";
// print_r(fgetcsv($file));
// echo "<br>";
// var_dump(fgetcsv($file));

while($row = fgetcsv($file)){
    echo "ID: {$row[0]} <br>";
    echo "Name: {$row[1]} <br>";
    echo "Batch: {$row[2]} <br>";
};
?>