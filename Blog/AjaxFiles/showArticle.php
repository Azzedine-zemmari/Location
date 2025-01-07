<?php

require "../Class/articleClass.php";

if(isset($_POST['theme'])){
    $theme = $_POST['theme'];
    $class = new article();

    $result = $class->showArticle($theme);

    echo json_encode($result);
}