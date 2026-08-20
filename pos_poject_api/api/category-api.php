<?php
function getCategories()
{
    // echo "Role api";
     echo json_encode(Category::getAll()) ;
}
?>