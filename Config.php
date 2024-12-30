<?php


class connection{
    private $host = "localhost";
    private $userName = "root";
    private $password = "Azzedine2004";
    private $dbName = "location";
    public $conn;
    public function conn(){
        try{
            $this->conn = new PDO(
                "mysql:host=".$this->host.";dbname=".$this->dbName, 
                $this->userName, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        }
        catch(PDOException $e){
            die("connection failed".$e->getMessage());
        }
    }
}