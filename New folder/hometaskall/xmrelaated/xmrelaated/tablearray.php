<?php

 $arr=[
    "Raju"=> 90,
    "Soikot" => 79,
    "Hasib" => 69,
    "Mina" => 59,
    "Rani" => 49
 ];

 function getGrade($score){
    if($score>=80) return 'A';
    if($score>=70) return 'B';
    if($score>=60) return 'C';
    if($score>=50) return 'D';
    return 'F';
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border ="1" cellpadding = "5" cellspacing ="0">
        <thead>
            <tr>
                <th>SL NO </th>
                <th>Name</th>
                <th>Score</th>
                <th>Grade</th>
            </tr>
        </thead>

        <tbody>

        <?php 
        $sl = 1;
        foreach($arr as $name => $score):
            $grade = getGrade($score);
        ?>

        <tr >
            <td><?= $sl++?></td>
            <td><?= $name?></td>
            <td><?=$score?></td>
            <td><?= $grade?></td>
        </tr>

        <?php endforeach; ?>


        

        
            
        </tbody>

    </table>
    
    <h4> Highest score : <?php $max_score = max($arr); echo $max_score;?></h4>
    <h4>Student name is :  <?php echo array_search($max_score, $arr);?></h4>






    
</body>
</html>