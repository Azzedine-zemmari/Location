<?php

require_once "../Class/articleClass.php";
if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $class = new article();

    $result = $class->search($title);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(["error" => "No articles found"]);
    }
} else {
    echo json_encode(["error" => "Theme parameter not set"]);
}