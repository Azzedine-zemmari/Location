<?php

require "../../Config.php";

class category{
    private $conn;
    public function __construct()
    {
        $connection = new connection();
        $this->conn = $connection->conn();
    }

    public function getCategory(){
        $query = "select * from category";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            echo "errrrrrro";
        }
        
    }
}