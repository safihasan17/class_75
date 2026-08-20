<?php
function  getBrands()
{
    // echo "Role api";
     echo json_encode(Brand::getAll()) ;
}

?>