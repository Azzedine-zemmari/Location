<?php 

require_once "../Class/articleClass.php";
if(isset($_POST['theme'])){
    $theme = $_POST['theme'];
    
    $class = new article();
    $result = $class->filterByTheme($theme);

    if($result){
        echo json_encode($result);
    }
    else{
        echo json_encode(["notFound" => "No articles found"]);
    }
}