<?php

require "../../Class/tagClass.php";

$id = $_GET['id'];

$class = new tags();
$method = $class->deleteTag($id);
if($method){
    header("Location: ../adminPage/tags.php");
}