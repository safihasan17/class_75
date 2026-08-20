<?php
function getRoles()
{
    // echo "Role api";
     echo json_encode(Role::getAll()) ;
}

?>