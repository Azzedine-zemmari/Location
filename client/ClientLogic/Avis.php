<?php
require_once "../../Config.php";

class avis{
    private $conn;
    public function __construct()
    {
        $connection = new connection();
        $this->conn = $connection->conn();
    }

    public function ajouterAvis($userId,$vehiculeId,$avis,$comment){
        $query = "insert into avis(userId,vehiculeId,avis,comment) values(:userId,:vehiculeId,:avis,:comment)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":userId",$userId);
        $stmt->bindParam(":vehiculeId",$vehiculeId);
        $stmt->bindParam(":avis",$avis);
        $stmt->bindParam(":comment",$comment);

        return $stmt->execute();
    }
    public function showAll($id){
        $query = "select * from getReviews where vehiculeId = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id",$id);

        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        else{
            return false;
        }
    }
    public function deleteReview($reviewId){
        $query = "update avis set deleted_at = CURRENT_TIMESTAMP() where id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id",$reviewId);

        return $stmt->execute();
    }

    public function updateReview($idAvis,$avis,$comment){
        $sql = "update avis set avis = :avis , comment = :comment , updated_at = CURRENT_TIMESTAMP() where id = :idAvis";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":avis",$avis);
        $stmt->bindParam(":comment",$comment);
        $stmt->bindParam(":idAvis",$idAvis);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
}