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

    <h3>Manufactures Detailes</h3>

    <?php
    if (isset($mfg)):

    ?>

        <p><b>ID:</b> <?= $mfg['id']; ?></p>
        <p><b>Name:</b> <?= $mfg['name']; ?></p>
        <p><b>Address:</b> <?= $mfg['address']; ?></p>
        <p><b>Is Active:</b> <?= $mfg['is_active'] ? "Active" : "Inactive"; ?></p>
    <?php
    else:
        echo "No data Found";
    endif;
    ?>

</body>

</html>