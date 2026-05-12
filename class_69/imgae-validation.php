<?php

$msg="";

if (isset($_POST["submit"])) {
    echo "<pre>";
    print_r($_FILES["image"]);
    echo "</pre>";

    $file = $_FILES["image"];
    // echo $file["tmp_name"];

    $file_path = "uploads/" . $file["name"];
    $type = !empty($file['tmp_name']) ? mime_content_type($file['tmp_name']) : "";
    echo $type;

    if($file['error']== 4){
        $msg = "<p class='fail'>Upload a File</p>";
    }
    elseif($file["size"] > (2 * 1024 * 1024)) {
        $msg = "<p class='fail'>File size should be less than 2MB</p>";
        
    } elseif (($type == 'image/jpeg' ||
        $type == 'image/png' ||
        $type == 'application/pdf' ||
        $type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') == false) {
        $msg=  "<p class='fail'>Invalid File type.Please Use Jpeg, Jpg, png, pdf or docx file.</p>";
    } 
    else {
        $msg = "<p class='success'>File Uploaded Succesfully</p>";
        move_uploaded_file($file["tmp_name"], $file_path);
        $image = "<img src='$file_path' width= '200px'height= '200px'>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .success{
            color: green;
        }

        .fail{
            color: red;
        }
    </style>
</head>

<body>


    <form action="" method="POST" enctype="multipart/form-data">

        <input type="file" name="image" id="">
        <input type="submit" name="submit" id="" value="upload">

    </form>

    <?= $image ?? "" ?>
    <?= $msg ?? "" ?>
</body>

</html>