<?php 
define('ROOT_PATH', dirname(__DIR__, 2));
include_once ROOT_PATH."/Config.php";

class commentaire{
    private $conn;
    protected $id;
    protected $userId;
    protected $comment;
    protected $articleId;



    public function __construct($comment = null,$userId = null,$articleId = null)
    {
        $connection = new connection();
        $this->conn = $connection->conn();
        $this->comment = $comment;
        $this->userId = $userId;
        $this->articleId = $articleId;
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            return null;
        }
    }
    public function __set($name,$value){
        if(property_exists($this,$name)){
            $this->$name = $value;
        }
    }

    public function showAllComments($id){
        $sql = "select * from blogcommentaire where articlId = :id";
    
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id",$id);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return "nothing to fetch";
        }
    }

    public function addComment(){
        $sql = "insert into blogcommentaire(comment,articlId,userId) values(:comment,:articlId,:userId)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":comment",$this->comment, PDO::PARAM_STR);
        $stmt->bindParam(":articlId",$this->articleId,PDO::PARAM_INT);
        $stmt->bindParam(":userId",$this->userId,PDO::PARAM_INT);
 
        if($stmt->execute()){
            return true;
        }
        else{
            echo "this is shit isnot working";
        }
    }
    public function deleteComment($id){
        $sql = "delete from blogcommentaire where id = :id";

        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(":id",$id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    // admin
    public function getAllComments(){
        $sql = "select article.title , client.nom, blogcommentaire.comment,blogcommentaire.id from location.blogcommentaire join article on article.id = blogcommentaire.articlId join client on client.id = blogcommentaire.userId;";
        $stmt = $this->conn->prepare($sql);

        if($stmt->execute()){
            return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            echo "error";
        }
        
    }
}