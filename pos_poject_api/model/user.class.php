<?php
class User
{
  public $id;
  public $name;
  public $email;
  public $phone;
  public $role_id;
  public $status;
  private $password;

  public function __construct($id, $name, $email, $phone, $role_id, $status, $password="")
  {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->phone = $phone;
    $this->role_id = $role_id;
    $this->status = $status;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  public static function getAll()
  {
    global $db;
    $query = "SELECT  u.id, u.name, u.email, u.phone, u.status, r.name as role   FROM  users u , roles r
      where u.role_id= r.id ORDER BY id DESC" ;
    $result = $db->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
  }


  public static function  getById($_id)
  {
    global $db;
    $query = "SELECT  u.id, u.name, u.email, u.phone, u.status,  r.name as role   FROM  users u , roles r
      where u.role_id= r.id  and u.id=$_id";
    $result = $db->query($query);
    return $result->fetch_assoc();
  }

  public function create()
  {
    global $db;
    $query = "insert into users(name, email, phone, role_id, status, password) values('$this->name', '$this->email', '$this->phone',  '$this->role_id', '$this->status', '$this->password')";
    $result = $db->query($query);

    if ($result) {
      return $db->insert_id;
    } else {
      return "Error:" . $db->error;
    }
  }


  public function update(){
    global $db;
    $query = "update users set name= '$this->name', phone = '$this->phone', role_id =$this->role_id, status= '$this->status' where id = $this->id";

    $result = $db->query($query);
    if($result){
      return "updated Successfully";
    }else{
      return "Error:" . $db->error;
    }

  }
}
