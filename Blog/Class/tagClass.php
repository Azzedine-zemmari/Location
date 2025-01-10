<?php 

// define('ROOT_PATH', dirname(__DIR__, 2));
include_once ROOT_PATH."/Config.php";
class tags{
    private $conn;
    protected $tag;
 

    public function __construct($tag = null)
    {
        $connection = new connection();
        $this->conn = $connection->conn();
        $this->tag = $tag;
    }
    public function getAllTags(){
        $sql = "select * from tags";
        $stmt = $this->conn->prepare($sql);

        if($stmt->execute()){
            return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }
    public function insertPostTag($articlId, $tagId) {
        // Assuming you have a database connection $db
        $stmt = $this->conn->prepare("INSERT INTO article_tag (articleId, tagId) VALUES (?, ?)");
        $stmt->bindParam("ii", $articlId, $tagId);
        $stmt->execute();
    }
}