<?php 

require "../../Config.php";

class Vehicule{
    private $conn;

    public function __construct()
    {
        $connection = new connection();
        $this->conn = $connection->conn();
    }

    public function getVehicule(){
        $query = "select * from ListeVehicules";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            echo "errrrrrro";
        }
        
    }
    public function detail($id){
        $query = "select * from Vehicule_Category_View where id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id",$id);

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            echo "error";
        }
    }
    public function search($name){
        $query = "select * from ListeVehicules where category_name LIKE :name";

        $stmt = $this->conn->prepare($query);
        
        $name = '%' . $name . '%';

        $stmt->bindParam(":name",$name);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return $stmt->errorInfo();
        }
    }
}