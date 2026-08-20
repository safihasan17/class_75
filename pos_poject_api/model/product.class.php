<?php
class Product{
    public $id;
    public $name;
    public $sku;
    public $category_id;
    public $brand_id;
    public $price;
    public $quantity;
    public $image;
    public $is_active;


     public function __construct($id, $name, $sku, $category_id, $brand_id, $price, $quantity, $image, $is_active)
    {
        $this->id = $id;
        $this->name = $name;
        $this->sku = $sku;
        $this->category_id = $category_id;
        $this->brand_id = $brand_id;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->image = $image;
        $this->is_active = $is_active;
    }

    public function create(){
        global $db;
        $sql = "INSERT INTO products( name , sku , category_id, brand_id, price, quantity, image, is_active )
        VALUES('$this->name', '$this->sku', $this->category_id, $this->brand_id, $this->price, $this->quantity, '$this->image', $this->is_active)";


        $result = $db->query($sql);
    if($result){
      return $db->insert_id;
    }else{
      return $db->error;
    }
    }
}

?>