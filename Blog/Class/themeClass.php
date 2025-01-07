<?php 

require_once "../../../Config.php";

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
        if($stmt->execute()){
            echo "<p>Success</p>";
        }
        else{
            echo "<p>Error</p>";
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
            echo '<p>Errror in theme show</p>';
        }
    }
}