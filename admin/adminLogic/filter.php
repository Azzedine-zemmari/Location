<?php

require "./Vehicule.php";

if(isset($_POST['category'])){
    $category = $_POST['category'];

    $class = new Vehicule();
    
    $result = $class->filtrage($category);

    echo json_encode($result);
}