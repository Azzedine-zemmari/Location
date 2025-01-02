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
    public function insert($categoryId,$model,$mark,$prix,$disponibilite,$color,$porte,$transmition,$personne,$image){
        $sql = "INSERT INTO vehicule (categorieId, model, mark, prix, disponibilite, color, porte, transmition, personne, image) 
                VALUES (:categorieId, :model, :mark, :prix, :disponibilite, :color, :porte, :transmition, :personne, :image)";

        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(":categorieId",$categoryId);
        $stmt->bindParam(":model",$model);
        $stmt->bindParam(":mark",$mark);
        $stmt->bindParam(":prix",$prix);
        $stmt->bindParam(":disponibilite",$disponibilite);
        $stmt->bindParam(":color",$color);
        $stmt->bindParam(":porte",$porte);
        $stmt->bindParam(":transmition",$transmition);
        $stmt->bindParam(":personne",$personne);
        $stmt->bindParam(":image",$image);

        if($stmt->execute()){
            return true;
        };
    }
}