<?php

namespace app;
use PDOException;
use PDO;

session_start();

class Order
{
    protected $user_id;
    protected $product_id;
    protected $product_name;
    protected $price;
    protected $image_path;
    protected $product_description;
    protected $size;
    protected $color;
    protected $product_quantity;
    protected $gender;
    protected $order_id;
    protected $total_amount;
    protected $order_status;
    protected $shipping_address;
    protected $order_date;
    protected $order_quantity;

    public function getOrderQuantity(){
        return $this->order_quantity;
    }

    public function getProdName(){
        return $this->product_name;
    }
    public function getTotalAmount(){
        return $this->total_amount;
    }
    public function getImage(){
        return $this->image_path;
    }
    public function getColor(){
        return $this->color;
    }
    public function getSize(){
        return $this->size;
    }
    public function getAddress(){
        return $this->shipping_address;
    }
    public function getDate(){
        return $this->order_date;
    }

    public function getStatus(){
        return $this->order_status;
    }

    public function getOrderID(){
        return $this->order_id;
    }

    public function getDescription(){
        return $this->product_description;
    }

    public function getGender(){
        return $this->gender;
    }
    

    public static function listOrders()
{
    global $conn;
    $user_id = $_SESSION['user']['id'];
    try {
        $sql = "
        SELECT
            p.product_name,
            p.product_description,
            p.price,
            p.gender,
            o.order_quantity,
            o.order_id,
            o.size,
            p.image_path,
            o.total_amount,
            o.shipping_address,
            o.order_date,
            o.order_status
        FROM
            orders AS o
            LEFT JOIN products AS p ON p.product_id = o.product_id
        WHERE
            o.user_id = :user_id
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([
            'user_id' => $user_id
        ]);
        $orders = [];
        while ($row = $statement->fetchObject('App\Order')) {
            array_push($orders, $row);
        }

        return $orders;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return []; // Return an empty array in case of an exception
    }
}

    public static function add($product_id, $user_id, $shipping_address, $total_amount, $order_status, $order_date, $payment_information,$order_quantity,$size)
    {
        global $conn;
        try {
            // Insert the order
            $sql = "
                INSERT INTO orders (product_id, user_id, shipping_address, total_amount, order_status, order_date, payment_information,order_quantity,size)
                VALUES ('$product_id', '$user_id', '$shipping_address', '$total_amount', '$order_status', '$order_date', '$payment_information','$order_quantity','$size')
            ";
            $conn->exec($sql);
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
    
    public static function updateAndDel($cart_id, $product_quantity, $product_id)
{
    global $conn;
    try {
        // Update the product quantity
        $updateSql = "UPDATE products
                      SET product_quantity = :product_quantity
                      WHERE product_id = :product_id";
        $updateStatement = $conn->prepare($updateSql);
        $updateStatement->execute([
            'product_id' => $product_id,
            'product_quantity' => $product_quantity
        ]);

        // Retrieve the item from the cart
        $selectSql = "SELECT * FROM cart WHERE cart_id = :cart_id";
        $selectStatement = $conn->prepare($selectSql);
        $selectStatement->execute([
            'cart_id' => $cart_id
        ]);
        $item = $selectStatement->fetch(PDO::FETCH_ASSOC);

        // Delete the item from the cart
        $deleteSql = "DELETE FROM cart WHERE cart_id = :cart_id";
        $deleteStatement = $conn->prepare($deleteSql);
        $deleteStatement->execute([
            'cart_id' => $cart_id
        ]);

        return $item;
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }
}


}

?>