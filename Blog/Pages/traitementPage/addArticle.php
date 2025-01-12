<?php
require "../../Class/articleClass.php";

if(isset($_POST['submit'])){
    $theme = $_POST['themeID'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    if (isset($_FILES['image'])) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = '../ClientPage/uploads/';
        $imagePath = $uploadDir . $imageName;

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
        }
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            echo "Image uploaded successfully.<br>";
        } else {
            echo "Failed to upload image.<br>";
        }
    }

    // Handle video upload
    $videoPath = null;
    if (isset($_FILES['vedeo'])) {
        $videoTmpName = $_FILES['vedeo']['tmp_name'];
        $videoName = basename($_FILES['vedeo']['name']);
        $uploadDir = '../ClientPage/uploads/vedeo/';
        $videoPath = $uploadDir . $videoName;

        // Move uploaded file to the desired directory
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
        }
        if (move_uploaded_file($videoTmpName, $videoPath)) {
            echo "Video uploaded successfully.<br>";
        } else {
            echo "Failed to upload video.<br>";
        }
    }

    $class = new article();
    // $insert = $class->addArticle($content,$imagePath,$videoPath,$title,$theme);
    if($insert){
        header("Location: ../ClientPage/index.php");
    }
}