<?php

class Product
{
    public $id;
    public $name;
    public $category_id;
    public $brand_id;
    public $short_description;
    public $price;
    public $quantity;
    public $point_of_reorder;
    public $image;
    public $is_active;

    public function __construct($_id, $_name, $_category_id, $_brand_id, $_price,
                                $_quantity, $_point_of_reorder, $_is_active, $_image, $_short_description)
    {
        $this->id = $_id;
        $this->name = $_name;
        $this->category_id = $_category_id;
        $this->brand_id = $_brand_id;
        $this->price = $_price;
        $this->quantity = $_quantity;
        $this->point_of_reorder = $_point_of_reorder;
        $this->is_active = $_is_active;
        $this->image = $_image;
        $this->short_description = $_short_description;
    }

    // Create a new product record
    public function create()
    {
        global $db;
        $sql = "INSERT INTO products (name, category_id, brand_id, price, quantity, point_of_reorder, is_active, image, short_description)
                VALUES ('$this->name', $this->category_id, $this->brand_id, $this->price, $this->quantity, $this->point_of_reorder, $this->is_active, '$this->image', '$this->short_description')";
        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    // Update an existing product
    public function update()
    {
        global $db;
        $sql = "UPDATE products SET
                name = '$this->name',
                category_id = $this->category_id,
                brand_id = $this->brand_id,
                price = $this->price,
                quantity = $this->quantity,
                point_of_reorder = $this->point_of_reorder,
                is_inactive = $this->is_active,
                image = '$this->image',
                short_description = '$this->short_description'
                WHERE id = $this->id";
        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }

    // Read all products
    static public function readAll()
    {
        global $db;
        $sql = "SELECT p.id, p.name, p.price, p.quantity, p.is_active, p.image, c.name as category, b.name as brand  
        FROM products p , brands b, categories c
        where p.brand_id=b.id and p.category_id = c.id";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Read a single product by ID
    static public function readById($_id)
    {
        global $db;
        $sql = "SELECT id, name, category_id, brand_id, price, quantity, point_of_reorder, is_inactive, image, short_description
                FROM products WHERE id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    // Delete a product by ID
    static public function delete($_id)
    {
        global $db;
        $db->query("DELETE FROM products WHERE id = $_id");
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }
}

?>