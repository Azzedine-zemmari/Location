<?php
require_once "../../Config.php";
class reservation {
    private $conn;
    public function __construct()
    {
        $connection = new connection();
        $this->conn = $connection->conn();
    }
    public function insertRservation($userId,$vehiculeId,$dateDebut,$dateFin,$lieuId){
        $query = "insert into reservation(userId,vehiculeId,date_debut,date_fin,lieuId) values(:userId, :vehiculeId, :dateDebut, :dateFin, :lieuId)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":userId",$userId);
        $stmt->bindParam(":vehiculeId",$vehiculeId);
        $stmt->bindParam(":dateDebut",$dateDebut);
        $stmt->bindParam(":dateFin",$dateFin);
        $stmt->bindParam(":lieuId",$lieuId);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
            echo $stmt->errorInfo();
        }

    }
    public function hasReservation($userId){
        $query = "select * from reservation where userId = :userId"; // logic error

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":userId",$userId);
        
        if ($stmt->execute()) {
            $result = $stmt->fetch(); // Fetch only the first row
            if($result){
                return true;
            }
            else {
                return false;
            }
        } 
    }
}