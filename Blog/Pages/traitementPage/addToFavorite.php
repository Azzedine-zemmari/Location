<?php 
session_start();
include "../../Class/articleClass.php";


$userId = $_SESSION['userId'];
$articleId = $_POST['article_id'];
$article = new article();
$addTo = $article->addtofavorite($articleId,$userId);

if($addTo){
    header("Location: ../ClientPage/index.php");
}