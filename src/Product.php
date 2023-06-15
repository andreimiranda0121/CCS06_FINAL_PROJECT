<?php

namespace app;

use PDO;
use PDOException;

class Product
{
    protected $product_id;
    protected $product_name;
    protected $price;
    protected $image_path;
    protected $product_description;
    protected $size;
    protected $color;
    protected $product_quantity;
    protected $gender;
    protected $category;

    public function getCategory(){
        return $this->category;
    }

    public function getProdID(){
        return $this->product_id;
    }

    public function getProdName(){
        return $this->product_name;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getImage(){
        return $this->image_path;
    }

    public function getSize(){
        return $this->size;
    }

    public function getColor(){
        return $this->color;
    }

    public function getQuantity(){
        return $this->product_quantity;
    }

    public function getDescription(){
        return $this->product_description;
    }

    public function getGender(){
        return $this->gender;
    }

    public static function listCategoryMen($category)
{
    global $conn;

    try {
        $sql = "
            SELECT * FROM products
            WHERE gender = 'Male'
            AND category = :category
        ";

        $statement = $conn->prepare($sql);
        $statement->execute([
            'category' => $category
        ]);

        $products = [];
        while ($row = $statement->fetchObject('App\Product')) {
            $products[] = $row;
        }

        return $products;
    } catch (PDOException $e) {
        echo $e->getMessage();
        error_log($e->getMessage());
    }
}


    public static function listItemMen(){
        global $conn;
        try{
            $sql="
                SELECT * FROM products
                WHERE gender='Male'
            ";

            $statement = $conn->query($sql);
            $prod = [];
            while($row = $statement->fetchObject('App\Product')){
                array_push($prod,$row);
            }

            return $prod;
        }catch (PDOException $e){
            echo $e->getMessage();
            error_log($e->getMessage());
        }
    }

    public static function listCategoryWomen($category)
{
    global $conn;

    try {
        $sql = "
            SELECT * FROM products
            WHERE gender = 'Female'
            AND category = :category
        ";

        $statement = $conn->prepare($sql);
        $statement->execute([
            'category' => $category
        ]);

        $products = [];
        while ($row = $statement->fetchObject('App\Product')) {
            $products[] = $row;
        }

        return $products;
    } catch (PDOException $e) {
        echo $e->getMessage();
        error_log($e->getMessage());
    }
}

    public static function listItemWomen(){
        global $conn;
        try{
            $sql="
                SELECT * FROM products
                WHERE gender='Female'
            ";
            $statement = $conn->query($sql);
            $prod = [];
            while($row = $statement->fetchObject('App\Product')){
                array_push($prod,$row);
            }

            return $prod;
        }catch (PDOException $e){
            echo $e->getMessage();
            error_log($e->getMessage());
        }
    }

    public static function list(){
        global $conn;

        try{
            $sql="
                SELECT * FROM products;
            ";

            $statement = $conn->query($sql);
            $products =[];
            while($row = $statement->fetchObject('App\Product')){
                array_push($products,$row);
            }
            return $products;
        }catch(PDOException $e){
            error_log($e->getMessage());
        }
    }

    public static function add($product_name, $price, $image_path, $product_description, $product_quantity, $gender, $category)
    {
        global $conn;

        try {
            $date = date('Y-m-d H:i:s');
            $sql = "INSERT INTO products (product_name, price, image_path, product_description, product_quantity,gender, date, category)
                    VALUES (:product_name, :price, :image_path, :product_description, :product_quantity, :gender, :date, :category)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image_path', $image_path);
            $stmt->bindParam(':product_description', $product_description);
            $stmt->bindParam(':product_quantity', $product_quantity);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':category', $category);

            $stmt->execute();

            return $conn->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            error_log($e->getMessage());
        }
    }


    public static function edit($product_id, $product_name, $price, $product_description, $product_quantity, $gender, $category, $image_path)
{
    global $conn;

    try {
        $sql = "
            UPDATE products
            SET
                product_name = :product_name,
                price = :price,
                product_description = :product_description,
                product_quantity = :product_quantity,
                gender = :gender,
                image_path = :image_path,
                category = :category
            WHERE product_id = :product_id
        ";
        $statement = $conn->prepare($sql);
        return $statement->execute([
            'product_name' => $product_name,
            'price' => $price,
            'product_description' => $product_description,
            'product_quantity' => $product_quantity,
            'gender' => $gender,
            'category' => $category,
            'image_path' => $image_path,
            'product_id' => $product_id
        ]);
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }

    return false;
}

    public static function getById($product_id){
        global $conn;
        try{
            $sql = "
                SELECT * FROM products
                WHERE product_id=:product_id
                LIMIT 1
            ";
            $statement = $conn->prepare($sql);
            $statement->execute([
                'product_id' => $product_id
            ]);
            $result = $statement->fetchObject('App\Product');

            return $result;
        }catch (PDOException $e){
            error_log($e->getMessage());
        }

        return null;
    }

    public static function delProd($product_id){
        global $conn;
        try{
            $sql = "
                DELETE FROM products
                WHERE product_id=:product_id
            ";
            $statement = $conn->prepare($sql);
            return $statement->execute([
                'product_id' => $product_id
            ]);
        }catch (PDOException $e){
            error_log($e->getMessage());
        }
    }


}

?>