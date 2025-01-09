<?php
include "../../Config.php";
class commentaire{
    private $conn;
    protected $comment;


    public function __construct($conn=null,$comment=null)
    {
        $connection = new connection();
        $this->conn = $connection->conn();
        $this->comment = $comment;
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

}