<?php

/*
  
 */
 //if-else

$x =10;
if($x>5){
    echo "x is greater than 5";
}else{
    echo "x is less than 5";
}

echo "<br>===============<br>";

$y =5;
if($y>0){
    echo "Y is positive number";
}elseif($y<0){
    echo "y is negative number";
}else{
    echo "y is Zero";
}

//switch

echo "<br>===============<br>";
$day ="Tuesday";
switch($day){
    case "sunday":
        echo "First day of week";
        break;

    case "Monday":
        echo " 2nd day of week";
        break;
    case "Friday":
        echo " weekend day";
        break;
    case "wednesday":
        echo " regular day";
        break;
    default:
       echo "Regular day";
}

//loop

echo "<br>===============<br>";

for($i =0; $i<10; $i++){
    // if($i ==5) break;
    if($i == 5) continue;
    echo $i . "<br>";
}

//while

echo "<br>===============<br>";

$z= 5;
while ($z>0){
    echo $z . "<br>";
    $z--;
}
echo "<br>z = $z";

echo "<br>===============<br>";

do{
    echo "Do while z = " . $z . "<br>";
    $z--;
}while($z>0);

//foreach

echo "<br>====foreach===========<br>";

$arr = ["a", "b", "c","d", "e"];
foreach($arr as $value){
    echo $value . "<br>";
}

echo "<br>===============<br>";

foreach($arr as $index => $value){
    echo $index . " :" . $value . "<br>";
    }
?>