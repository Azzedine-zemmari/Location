<?php 

require "../../Class/themeClass.php";


$id = $_GET['theme'];
$class = new them();
$delete = $class->delete($id);
if($delete){
    header("Location: ../adminPage/ThemeDashboard.php");
}