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
        $query = "select * from vehicule ";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            echo "errrrrrro";
        }
        
    }
}