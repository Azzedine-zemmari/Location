<?php 
session_start();
include "../../Config.php";

class authentification{
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
}