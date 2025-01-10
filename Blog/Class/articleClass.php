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
    
        // $offset = ($page - 1) * $itemPerPage;
        
        // $query =  "select count(*) as total from article";

        // $countStmt = $this->conn->prepare($query);
        // $countStmt->execute();
        // $totalCount =$countStmt->fetch(PDO::FETCH_ASSOC);
        // $total = $totalCount['total'];

    $sql = "SELECT 
    article.*,
    JSON_ARRAYAGG(tags.tag) AS tags,
    JSON_ARRAYAGG(blogcommentaire.comment) AS comments
FROM 
    location.article AS article
LEFT JOIN 
    blogcommentaire
    ON blogcommentaire.articlId = article.id
LEFT JOIN 
    location.tags AS tags 
    ON tags.articlId = article.id
GROUP BY 
    article.id;
";
    $stmt = $this->conn->query($sql);
    // $stmt->bindParam(":limit",$itemPerPage,PDO::PARAM_INT);
    // $stmt->bindParam(":offset",$offset,PDO::PARAM_INT);
        // return[
        //     'result' => $stmt->fetchAll(PDO::FETCH_ASSOC),
        //     'totalElement'=>$total,
        //     'totalPage' => ceil($total/$itemPerPage)
        // ];
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}