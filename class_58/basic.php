<?php
    //echo "Php Data Type", "-", "PHP top2 <br>";
   # echo "New Line <br>" ;
/*
    echo "<br>"."2546"."<br>";
    print "Print Line <br>" ; 
    print("print line");
*/
    $arr =["PHP", "HTML","CSS", 5411];
    const PI =3.1416;
    print_r($arr);
    echo"<br>";
    var_dump($arr);

    echo"<br>";

    $name= "Mina";
    $age = 25;

    printf("Her name is %s and age is %d", $name, $age );
    echo"<br>";
    $str =  sprintf("Her name is %s and age is %d", $name, $age );
    echo $str;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello PHP</h1>
    <h3><?php echo "PHP inside Html"; ?></h3>
    <h3><?= "New PHP inside HTML";?></h3>


</body>
</html>

<?="PHP Bottom";?>
<br>
<? echo "PHP Bottom";?>