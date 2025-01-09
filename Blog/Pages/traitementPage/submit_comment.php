<?php 
session_start();
include __DIR__ . '/../../Class/Commentaire.php';

if(isset($_POST['submit'])){
    $userId = $_SESSION['userId'];
    $comment = $_POST['comment'];
    $articlId = $_POST['article_id'];
    
    $comments = new commentaire($comment,$userId,$articlId);
    $addComment = $comments->addComment();
    if($addComment){
        header("Location: ../ClientPage/index.php");
    }
    else{
        echo "false";
    }
    
}
