<?php
if (isset($_POST["submit"])) {
    $skill = $_POST["check"] ?? [];

    

    if(count($skill)<1){
        echo "<span style ='color: red'> Please select at least One</span>";
    }else{
        echo "you selected" . count($skill) . "  skill" . (count($skill)>1 ? "s": "");
    }
  
    // echo "<pre>";
    // print_r($_POST["check"]);
    // echo "</pre>";
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
    <form method="POST">
        <input type="checkbox" name="check[]" value="1">1
        <input type="checkbox" name="check[]" value="2">2
        <input type="checkbox" name="check[]" value="3">3
        <input type="checkbox" name="check[]" value="4">4
        <input type="checkbox" name="check[]" value="5">5
        <input type="submit" name="submit" value="submit">

    </form>

</body>

</html>