<?php 
session_start();
include "../../Config.php";

class user{
    private $conn;
    public $name;
    public $prenom;
    public $email;
    public $password;

    public function __construct()
    {
        $connection = new connection();
        $this->conn = $connection->conn();
    }

    public function register($nom,$prenom,$email,$password){
        $this->name = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = password_hash($password,PASSWORD_BCRYPT);

        $query = "insert into client(nom,prenom,email,password) values(:nom,:prenom,:email,:password)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom",$this->name);
        $stmt->bindParam(":prenom",$this->prenom);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":password",$this->password);

        if($stmt->execute()){
            $userId = $this->conn->lastInsertId();

            $_SESSION['userId'] = $userId;
            $_SESSION['role'] = 'user';

            return true;
        }
        else{
            return false;
        }
    }
    public function login($email,$password){
        $this->email = $email;

        $query = "select * from client where email = :email";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email",$this->email);

        if($stmt->execute()){
            $user = $stmt->fetch();

            if(password_verify($password,$user['password'])){
                $_SESSION['userId'] = $user['id'];
                $_SESSION['role'] = 'user';
                return true;
            }
            else{
                return false;
                echo "password incorect";
            }
        }
        else{
            echo "no user found";
        }
    }

    public function logout(){
        session_start();

        session_unset();


        header("Location: ./LoginAdmin.php");
        exit();
    }
    public function showUsers(){
        $sql = "select * from client";
        $stmt = $this->conn->prepare($sql);

        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            echo "error";
        }
    }
}