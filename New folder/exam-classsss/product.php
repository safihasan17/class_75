<?php
require_once("confiq.php");
$sql= "
select p.*, m.name as mfg
from product as p , manufactuer as m
where p.manufacturer_id = m.id
";
$result=  $db->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);


$result_view = $db->query("select * from vw_product");
$rows_view =$result_view->fetch_all(MYSQLI_ASSOC);





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
    <a href="manufacturer.php">Manufacture List</a>
    <a href="product.php">products</a>
</nav>


<h1>Product view more than 5000</h1>

<table border="1" width="400">
   
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>price</th>
            <th>mfg</th>
           
        </tr>
    
        <?php foreach($rows_view as $item): ?>

        <tr>
            <td><?= $item['id']; ?></td>
            <td><?= $item['name']; ?></td>
            <td><?= $item['price']; ?></td>
            <td><?= $item['mfg']; ?></td>
        </tr>

        
        <?php endforeach?>
      
</table>



<h1>product List</h1>

<table border="1" width="400">
   
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>price</th>
            <th>mfg</th>
           
        </tr>
    
        <?php foreach($rows as $item): ?>

        <tr>
            <td><?= $item['id']; ?></td>
            <td><?= $item['name']; ?></td>
            <td><?= $item['price']; ?></td>
            <td><?= $item['mfg']; ?></td>
        </tr>

        
        <?php endforeach?>
      
</table>

</body>
</html>