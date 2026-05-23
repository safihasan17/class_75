<?php
require_once "db-config.php";

if(isset($_POST['add-mfg'])){
    $name= $_POST['name'];
    $address= $_POST['address'] ;
    $active= isset($_POST['active']) ? 1: 0;

    $db->query("insert into manufactures(name, address, is_active) values('$name', '$address', $active)");  
}

//delete data

if(isset($_POST['delete_id'])){
    $id= $_POST['delete_id'];
    $db->query("delete from manufactures where id = $id");
}

$result = $db->query("select * from manufactures");

if ($result) {
    $mfg = $result->fetch_all(MYSQLI_ASSOC);
    // echo "<pre>";
    // print_r($mfg);
    // echo "</pre>";
} else {
    echo $db->error;
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

    <div style="display: flex; gap: 80px">
        <div>
            <h2>Add new manufacture</h2>
            <form action="" method="POST">
                <label for="">Name</label><br>
                <input type="text" name="name" id="name"> <br><br>

                <label for="">Address</label> <br>
                <input type="text" name="address" id="adress"> <br> <br>

                <input type="checkbox" name="active" id="active">
                <label for="">Is active</label> <br> <br>

                <button type="submit" name="add-mfg">Save</button>
            </form>

        </div>

        <div>
            <h3>Manufacture List</h3>

            <table border="2" width="300">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if(isset($mfg)):
                        foreach ($mfg as $item):
                    ?>

                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['address'] ?></td>
                        <td><?= $item['is_active'] ? "active" : "Inactive"; ?></td>
                        
                        <td>
                           <form method="POST">
                            <input type="hidden" name="delete_id" value="<?= $item['id']; ?>">
                            <button>Delete</button>
                           </form>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    endif;

                    ?>
                    


                </tbody>

            </table>
        </div>
    </div>
</body>

</html>