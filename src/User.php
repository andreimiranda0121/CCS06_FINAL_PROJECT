<?php

namespace app;
use PDOException;


class User
{
    protected $username;
    protected $password;
    protected $roles;
    protected $user_id;
    protected $email;
    protected $shipping_address;
    protected $contact;
    protected $fullname;

    public function getFullname(){
        return $this->fullname;
    }

    public function getContact(){
        return $this->contact;
    }

    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getID()
    {
        return $this->user_id;
    }

    public function getRole()
    {
        return $this->roles;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getShipping(){
        return $this->shipping_address;
    }

    
    public static function attemptLogin($username, $password)
{
    global $conn;

    try {
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password LIMIT 1";

        $statement = $conn->prepare($sql);
        $statement->execute([
            ':username' => $username,
            ':password' => $password
        ]);

        $result = $statement->fetchObject('App\User');
        return $result;
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }

    return null;
}

public static function register($username, $password, $role, $fullname, $address, $email, $contact)
{
    global $conn;

    try {
        // Check if username or email already exists
        $checkQuery = "SELECT COUNT(*) FROM users WHERE username = ? OR email = ?";
        $stmtCheck = $conn->prepare($checkQuery);
        $stmtCheck->execute([$username, $email]);
        $count = $stmtCheck->fetchColumn();

        if ($count > 0) {
            echo "
            <script>
                alert('Registration failed. Username or email already exists.');
                window.history.back();
            </script>";
            return false;
        }
        

        // Insert the new user
        $insertQuery = "
            INSERT INTO users (username, password, roles, fullname, shipping_address, email, contact)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ";

        $stmtInsert = $conn->prepare($insertQuery);
        $stmtInsert->execute([$username, $password, $role, $fullname, $address, $email, $contact]);

        return $conn->lastInsertId();
    } catch (PDOException $e) {
        echo "Registration failed. Error: " . $e->getMessage();
        error_log($e->getMessage());
    }

    return false;
}



    public static function getById($user_id){
        global $conn;
        try{
            $sql = "
                SELECT * FROM users
                WHERE user_id =:user_id
                LIMIT 1
            ";
            $statement = $conn->prepare($sql);
            $statement->execute([
                'user_id' => $user_id
            ]);
            $result = $statement->fetchObject('App\User');

            return $result;
        }catch (PDOException $e){
            error_log($e->getMessage());
        }
        return null;
    }

    public static function update($user_id, $username, $password, $fullname, $address, $email, $contact) {
        global $conn;
        try {
            $sql = "UPDATE users
                    SET username = :username,
                        password = :password,
                        fullname = :fullname,
                        shipping_address = :shipping_address,
                        email = :email,
                        contact = :contact
                    WHERE user_id = :user_id";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':shipping_address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contact', $contact);
            $stmt->bindParam(':user_id', $user_id);
            $result = $stmt->execute();
           
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            error_log($e->getMessage());
        }
    }
    

}


?>