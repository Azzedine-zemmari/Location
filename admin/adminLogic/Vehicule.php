<?php 

require_once "../../Config.php";

class Vehicule{
    private $conn;

    public function __construct()
    {
        $connection = new connection();
        $this->conn = $connection->conn();
    }

    public function getVehicule($page=1,$itemPerPage = 4){

        $offset = ($page - 1) * $itemPerPage;

        //count query
        $query = "select count(*) as total from ListeVehicules";

        $countStmt = $this->conn->prepare($query);
        $countStmt->execute();
        $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC);
        $total = $totalCount['total'];
        //get all with the pagination
        $sql = "select * from ListeVehicules limit :limit offset :ofsset";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":limit",$itemPerPage,PDO::PARAM_INT);
        $stmt->bindParam(":ofsset",$offset,PDO::PARAM_INT);

        

        if($stmt->execute()){
            return [
                'vehicules' => $stmt->fetchAll(PDO::FETCH_ASSOC),
                'totalElement' => $total,
                'totalPage' => ceil($total/$itemPerPage)
        ];
        }
        else{
            echo "errrrrrro";
        }
        
    }
    // get vehicule without pagination
    public function getAllVehicule(){
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
    public function insertMultipleVehicles($vehicles) {
        try {            
            $sql = "INSERT INTO vehicule (categorieId, model, mark, prix, disponibilite, color, porte, transmition, personne, image) 
                    VALUES (:categorieId, :model, :mark, :prix, :disponibilite, :color, :porte, :transmition, :personne, :image)";
            
            $stmt = $this->conn->prepare($sql);
            
            foreach ($vehicles as $vehicle) {
                $stmt->execute([
                    ':categorieId' => $vehicle['categorieId'],
                    ':model' => $vehicle['model'],
                    ':mark' => $vehicle['mark'],
                    ':prix' => $vehicle['prix'],
                    ':disponibilite' => $vehicle['disponibilite'],
                    ':color' => $vehicle['color'],
                    ':porte' => $vehicle['porte'],
                    ':transmition' => $vehicle['transmition'],
                    ':personne' => $vehicle['personne'],
                    ':image' => $vehicle['image']
                ]);
            }
            
            return true;
            
        } catch (PDOException $e) {
            echo "error" . $e->getMessage();
        }
    }

    public function selectID($id){
        $sql = "select * from vehicule where id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id",$id);

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            echo "error";
        }
    }
    public function update($id, $category, $model, $mark, $prix, $disponibilite, $color, $porte, $transmition, $personne, $image) {
        try {
            $sql = "UPDATE vehicule 
                    SET categorieId = :category,
                        model = :model,
                        mark = :mark,
                        prix = :prix,
                        disponibilite = :disponibilite,
                        color = :color,
                        porte = :porte,
                        transmition = :transmition,
                        personne = :personne,
                        image = :image
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
    
            // Bind parameters
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':mark', $mark);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':disponibilite', $disponibilite);
            $stmt->bindParam(':color', $color);
            $stmt->bindParam(':porte', $porte);
            $stmt->bindParam(':transmition', $transmition);
            $stmt->bindParam(':personne', $personne);
            $stmt->bindParam(':image', $image);
    
            // Execute the query
            if($stmt->execute()){
                return true;
            }
    
            echo "Vehicle updated successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function deleteVehicule($id){
        $sql = "delete from vehicule where id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    
}