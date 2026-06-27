<?php

$msg ="";
$image = "";

if(isset($_POST['submit'])){
     echo "<pre>";
     print_r ($_FILES['image']);
     echo "</pre>";

    $file= $_FILES['image'];

    $file_path = "uploads/". $file['name'];

    $type = !empty($file['tmp_name']) ? mime_content_type($file['tmp_name']) : "";

    if($file['error']== 4){
        $msg = "Uplpad a File";
    }elseif($file['size'] > (500*1024)){
        $msg = "File size must be less than 500 kb";
    }elseif(($type = 'image/jpeg' ||
    $type == 'image/jpg'||
    $type =='image/png'||
    $type == 'application/pdf'||
    $type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") == false){
        $msg = "upload a valid File";
    }else{
        $msg = "File Upload Successfully";
        move_uploaded_file($file["tmp_name"], $file_path );
        $image = "<img src='$file_path' height= 200px width= '200px' >";
    };

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
    
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" id="">
    <input type="submit" name="submit" id="" value="upload"> 
  </form>

  <h3><?php echo $msg ;?></h3>
  <h3><?php echo $image ;?></h3>
</body>
</html>