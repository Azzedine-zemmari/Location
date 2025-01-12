<?php 

define('ROOT_PATH', dirname(__DIR__, 2));
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
    // public function insertPostTag($articlId, $tagId) {
    //     // Assuming you have a database connection $db
    //     $stmt = $this->conn->prepare("INSERT INTO article_tag (articleId, tagId) VALUES (?, ?)");
    //     $stmt->bindParam("ii", $articlId, $tagId);
    //     $stmt->execute();
    // }
    public function insertTags($tagsArray)
    {
        try {
            // Start a transaction to ensure atomicity
            $this->conn->beginTransaction();
            
            foreach ($tagsArray as $tag) {
                // Prepare SQL query to insert the tag into the database
                $sql = "INSERT INTO tags (tag) VALUES (:name)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":name", $tag);
                $stmt->execute();
            }

            // If all inserts are successful, commit the transaction
            $this->conn->commit();
            echo "Tags inserted successfully!";
        } catch (Exception $e) {
            // If an error occurs, roll back all operations
            $this->conn->rollBack();
            echo "Failed to insert tags: " . $e->getMessage();
        }
    }
    public function deleteTag($id){
        $sql = "delete from tags where id = :id";

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