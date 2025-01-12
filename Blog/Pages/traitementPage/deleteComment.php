<?php

require "../../Class/Commentaire.php";

$id = $_GET['id'];

$class = new commentaire();
$method = $class->deleteComment($id);
if($method){
    header("Location: ../adminPage/comment.php");
}