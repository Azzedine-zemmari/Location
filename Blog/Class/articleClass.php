<?php 

include_once "../../Config.php";

class article{
    private $conn;
    protected $title;
    protected $descripition;
    protected $media;
    protected $vedeo;

    public function __construct($descripition = null,$media=null , $vedeo = null,$title =null)
    {
        $connection = new connection();
        $this->conn = $connection->conn();
        $this->descripition = $descripition;
        $this->media = $media;
        $this->vedeo = $vedeo;
        $this->title = $title;
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
        echo "ERROR";
    }
    }
    public function addArticle($descripition,$media,$vedeo,$title ,$themeId){
        $sql = "insert into article(content,media,vedio,themeId,title) values(:content,:media,:vedio,:themeId,:title)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":content",$descripition);
        $stmt->bindParam(":media",$media);
        $stmt->bindParam(":vedio",$vedeo);
        $stmt->bindParam(":themeId",$themeId);
        $stmt->bindParam(":title",$title);
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }
    public function search($titre){
        $sql = "select * from article where title = :titre ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":titre",$titre);

        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        else{
            return false;
        }

    }
    public function filtrage($tagId){
        $sql = "select article.* , tags.tag  from article_tag
        join article on article.id = article_tag.articleId 
        join tags on tags.id = article_tag.tagId 
        where tags.id = :tagId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":tagId",$tagId);
        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        else{
            return false;
        }

    }
}