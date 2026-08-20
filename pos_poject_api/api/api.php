<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-control-Allow-Headers: Content-Type");

if($_SERVER["REQUEST_METHOD"]==="OPTIONS"){
    http_response_code(204);
    exit;
}

require_once "../config/db.php";
// require_once "../model/user.class.php";
// require_once "user-api.php";

foreach(glob("../model/*.class.php") as $modelfile){
    require_once $modelfile;
}

foreach(glob("*-api.php") as $apifile){
    require_once $apifile;
}

if($_GET['endpoint']){
    $endpoint = $_GET['endpoint'];

    $method=$_SERVER['REQUEST_METHOD'];

    if($endpoint== "users" && $method=="GET"){
        getAll();

    }elseif($endpoint == "user-create"  && $method== "POST"){
        // echo "<h1>User create</h1>";
         $data = json_decode(file_get_contents("php://input"), true);
         
    //     $data= [
        //   "name" =>"Shafi",
        //   "email" =>"eample@gmail.com",
        //   "phone"=>"45666",
        //   "role_id"=> 2,
        //   "status"=>"active",
        //   "password" =>"123"
    //    ];
    //    print_r($data);
        addNew($data);

    }elseif($endpoint == "user-update"  && $method== "PUT"){
        // echo "<h1>User updated</h1>";
        $data = json_decode(file_get_contents("php://input"), true);
        // print_r($data);exit;
        updateUser($data);

    }elseif($endpoint == "user-delete" && $method== "DELETE"){
        echo "<h1>User delated</h1>";

    }elseif($endpoint == "user-details" && $method=="GET"){
        $id =$_GET['id'];
        getuserById($id);
    }elseif($endpoint == "roles" && $method=="GET"){
        getRoles();

    }elseif($endpoint == "categories" && $method=="GET"){
        getCategories();
    }
    
    elseif($endpoint == "brands" && $method=="GET"){
        getBrands();
    }

    elseif($endpoint == "product-create" && $method=="POST"){
        createProduct($_POST, $_FILES);
    }
     

    else{
        http_response_code(404);
    }
}else{
    echo "No endpoint Found";
}
?>


