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
    public function search($model){
        $query = "select * from ListeVehicules where model LIKE :model";

        $stmt = $this->conn->prepare($query);
        
        $model = '%' . $model . '%';

        $stmt->bindParam(":model",$model);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return $stmt->errorInfo();
        }
    }
    public function filtrage($category){
        $query = "select * from ListeVehicules where category_name LIKE :category";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":category",$category);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return $stmt->errorInfo();
        }


    }
}