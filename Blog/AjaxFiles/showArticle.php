<?php

require_once "../Class/articleClass.php";
if (isset($_POST['theme'])) {
    $theme = $_POST['theme'];
    $class = new article();

    $result = $class->showArticle($theme);
    
    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(["error" => "No articles found"]);
    }
} else {
    echo json_encode(["error" => "Theme parameter not set"]);
}