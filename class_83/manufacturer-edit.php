<?php
require_once "db-config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result =  $db->query("select * from manufactures where id = $id");

    if ($result) {
        $mfg = $result->fetch_assoc();
        // echo "<pre>";
        // print_r($mfg);
        // echo "</pre>";
    }
}

if (isset($_POST['update-mfg'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $active = isset($_POST['active']) ? 1 : 0;

    $result = $db->query("update manufactures set name = '$name', address = '$address', is_active= $active where id= $id ");

    if ($result) {
        header("location: manufacture.php");
    } else {
        echo $db->error;
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

    <nav>
        <a href="manufacture.php">Manufacture</a>
        <a href="products.php">Products</a>

    </nav>
    <h3>Manufactur edit</h3>
    <?php
    if (isset($mfg)):
    ?>

        <form action="" method="POST">
            <label for="">Name</label><br>
            <input type="text" name="name" id="name" value="<?= $mfg['name']; ?>"> <br><br>

            <label for="">Address</label> <br>
            <input type="text" name="address" id="adress" value="<?= $mfg['address']; ?>"> <br> <br>

            <input type="checkbox" name="active" id="active" <?= $mfg['is_active'] ? "checked" : ""; ?>>
            <label for="">Is active</label> <br> <br>

            <button type="submit" name="update-mfg">Update</button>
        </form>


    <?php
    endif;
    ?>


</body>

</html>