<?php 

require_once "../Class/articleClass.php";
if(isset($_POST['tag'])){
    $tag = $_POST['tag'];
    $class = new article();

    $result = $class->filtrage($tag);
    if($result){
        echo json_encode($result);
    }
    else{
        echo json_encode(["notFound" => "No articles found"]);
    }
}