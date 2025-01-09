<?php
session_start();

include "../../Class/articleClass.php";

$userId = $_SESSION['userId'];
$articles = new article();
$favorites = $articles->showallFavoriteArticle($userId);

?>