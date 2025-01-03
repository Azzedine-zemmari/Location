<?php

require "../../client/ClientLogic/reservationLogic.php";


$id = $_GET['id'];
$reservation = new reservation();
$accept = $reservation->acceptReserve($id);

if($accept){
    header("Location: ./ReservationDash.php");
}
else{
    echo "error";
}