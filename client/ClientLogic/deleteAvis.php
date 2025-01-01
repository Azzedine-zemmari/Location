<?php
require "./Avis.php";


if (isset($_GET['id'])) {
    $id = $_GET['id']; 

    $activiteClass = new avis(); 

    if ($activiteClass->deleteReview($id)) {
        header("Location: ../fromtClient/index.php");
        exit();
    } else {
        return "error in the delete function";
        exit();
    }
} else {
    echo "error";
    exit();
}
