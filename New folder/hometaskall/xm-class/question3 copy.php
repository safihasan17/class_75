<?php

$arr = [
    "Mina" => 50,
    "Raju" => 60,
    "Mithu" => 40,
    "piku" => 59,
    "Rakib" => 55
];





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Score</th>
            </tr>
        </thead>

        <tbody>
            <!-- <?php  foreach ($arr as $name => $score) { ?>
              <tr>
                <td><?= $name; ?></td>
                <td><?= $score; ?></td>
              </tr>

              <?php } ?> -->

              <?php  foreach ($arr as $name => $score) : ?>
              <tr>
                <td><?= $name; ?></td>
                <td><?= $score; ?></td>
              </tr>

              <?php endforeach; ?>


            

            

        </tbody>


    </table>

    <h5>Highest Score is : <?php $max_score= max($arr);  echo $max_score;?></h5>
    <h5>Student Name  is : <?php echo array_search($max_score,  $arr); ?></h5>

</body>

</html>