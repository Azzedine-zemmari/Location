<?php

require "../adminLogic/Vehicule.php";

$id=$_GET['id'];
$vehicule = new Vehicule();
$delete = $vehicule->deleteVehicule($id);

if($delete){
    header("Location: ./VehiculeDah.php");
}