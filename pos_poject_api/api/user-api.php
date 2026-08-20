<?php

function getAll(){
   echo json_encode(User::getAll()) ;
}

function getuserById($_id){
   echo json_encode(User::getById($_id))  ;
}

function addNew($_data){
//   echo json_encode($_data);
   
$user = new User(null, $_data["name"],$_data["email"], $_data["phone"], $_data["role_id"], $_data["status"], $_data["password"]);
echo json_encode($user->create()) ;

}

function updateUser($_data){
   $user = new User($_data["id"], $_data["name"], null, $_data["phone"], $_data["role"], $_data["status"]);
echo json_encode($user->update()) ;
}

?>