<?php 

require "../../Config.php";

class article{
    private $conn;
    protected $descripition;
    protected $media;

    public function __construct($descripition = null,$media=null )
    {
        $connection = new connection();
        $this->conn = $connection->conn();
        $this->descripition = $descripition;
        $this->media = $media;
    }
    // show article based on there theme
    public function showArticle($themeId){
    $sql = "select * from article where themeId = :themeId";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":themeId",$themeId);
    if($stmt->execute()){
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    else{
        echo "<p>ERROR</p>";
    }
    }
}