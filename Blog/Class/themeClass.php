<?php 
define('ROOT_PATH', dirname(__DIR__, 2));
include_once ROOT_PATH."/Config.php";

class them{
    private $conn;
    protected $themenom;

    public function __construct($themenom = null)
    {
        $this->themenom = $themenom;
        $connect = new connection();
        $this->conn = $connect->conn();
    }

    public function ajouterTheme(){
        $sql = 'insert into theme(name) values(:name)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name",$this->themenom);
    if ($stmt->execute()) {
        return "Theme added successfully!";
    } else {
        return "Error adding theme!";
    }
    }
    public function showAll(){
        $sql = 'select * from theme';
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        else{
            echo 'Errror in theme show';
        }
    }
    public function delete($id){
        $sql = "delete from theme where id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        if($stmt->execute()){
            return true;
        }

    }
}