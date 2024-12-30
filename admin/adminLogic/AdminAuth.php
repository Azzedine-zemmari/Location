<?php 
require "../../Config.php";
class adminAuth{
    private $conn;
    public $email;
    public $password;

    public function __construct()
    {
        $connection = new connection();
        $this->conn = $connection->conn();
    }

    public function login($email,$password){
        $this->email = $email;

        $query = "select * from client where email = :email";
        $stmt= $this->conn->prepare($query);

        $stmt->bindParam(":email",$this->email);

        if($stmt->execute()){
            $user = $stmt->fetch();
            if($password == $user['password']){
                return true;
            }
            else{
                echo "password invalid";
                return false;
            }
        }
        else{
            echo "user not found";
        }
    }
}