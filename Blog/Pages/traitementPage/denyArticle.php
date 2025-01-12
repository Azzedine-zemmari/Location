<?php

require "../../Class/articleClass.php";

$id = $_GET['id'];

$class = new article();
$method = $class->deny($id);
if($method){
    header("Location: ../adminPage/ThemeDashboard.php");
}