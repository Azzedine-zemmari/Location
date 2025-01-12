<?php 

define('ROOT_PATH', dirname(__DIR__, 2));
include_once ROOT_PATH."/Config.php";

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
    public function showArticles(){

    $sql = "SELECT 
    article.*,
    JSON_ARRAYAGG(tags.tag) AS tags,
    JSON_ARRAYAGG(blogcommentaire.comment) AS comments
FROM 
    location.article AS article
LEFT JOIN 
    location.article_tag AS article_tag
    ON article.id = article_tag.articleId
LEFT JOIN 
    location.tags AS tags
    ON article_tag.tagId = tags.id
LEFT JOIN 
    location.blogcommentaire AS blogcommentaire
    ON blogcommentaire.articlId = article.id
GROUP BY 
    article.id;
";
    $stmt = $this->conn->query($sql);
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addArticle($descripition,$media,$vedeo,$title ,$themeId,$tags){
        try{
            $this->conn->beginTransaction();
            $sql = "insert into article(content,media,vedio,themeId,title) values(:content,:media,:vedio,:themeId,:title)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":content",$descripition);
            $stmt->bindParam(":media",$media);
            $stmt->bindParam(":vedio",$vedeo);
            $stmt->bindParam(":themeId",$themeId);
            $stmt->bindParam(":title",$title);
            if($stmt->execute()){
                $articleId = $this->conn->lastInsertId();
                if(!empty($tags)){
                    $sqlTAGS = "INSERT INTO article_tag(articleId,tagId) values(:article_id,:tag_id)";
                    $STMTTags = $this->conn->prepare($sqlTAGS);

                    foreach($tags as $tagId){
                        $STMTTags->bindParam(":article_id",$articleId);
                        $STMTTags->bindParam(":tag_id",$tagId);
                        $STMTTags->execute();
                    }
                }
                $this->conn->commit();
                return true;
            }
            else{
                $this->conn->rollBack();
                return false;
            }
        }
        catch(Exception $e){
            $this->conn->rollBack();
            throw new Exception("Error adding article and tags : ",$e->getMessage());
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
    public function addtofavorite($articleId,$userId){
        $sql = "insert into favorite(articleId,userId) values(:articleId,:userId)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":articleId",$articleId);
        $stmt->bindParam(":userId",$userId);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function showallFavoriteArticle($userId){
        $sql = "select * from favorite join article on article.id = favorite.articleId where userId = :userId";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":userId",$userId);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }

    // work on filter by theme
    public function filterByTheme($theme){
        $sql = "select * from article where themeId = :themeId";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":themeId",$theme);

        if($stmt->execute()){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        else{
            return false;
        }
    }
    // admin 
    public function ShowallArticles(){
        $sql = "select article.*,theme.name as themeName from location.article join theme on theme.id = article.themeId";
        $stmt = $this->conn->prepare($sql);

        if($stmt->execute()){
            return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return null;
        }
        
    }
    public function approve($id){
        $sql = "update article set status = 'ok' where id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    public function deny($id){
        $sql = "update article set status = 'no' where id = :id";

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