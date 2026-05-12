<?php
if(isset($_POST["submit"])){
    echo "<pre>";
    print_r($_FILES["image"]);
    echo "</pre>";

    $file = $_FILES["image"];
    // echo $file["tmp_name"];

      $file_path = "uploads/".$file["name"];


    if($file["size"]>(120*1024)){
        echo "File size should be less than 120kb";
    }else{
        echo "File Uploaded Succesfully";
        move_uploaded_file($file["tmp_name"], $file_path);

    }

  
    
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
    

   <form action="" method="POST"  enctype="multipart/form-data">

   <input type="file" name="image" id="">
   <input type="submit" name="submit" id="" value="upload">
     
   </form>
</body>
</html>