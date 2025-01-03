<?php

require "../../Config.php";

class statics
{
    private $conn;
    public function __construct()
    {
        $connection = new connection();
        $this->conn = $connection->conn();
    }
    public function getUserCount()
    {
        $sql = "select count(*) from client";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            return (int) $stmt->fetchColumn();
        }
    }
    public function getVehiculeCount()
    {
        $sql = "select count(*) from vehicule";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            return (int) $stmt->fetchColumn();
        }
    }
    public function getReservationCount()
    {
        $sql = "select count(*) from reservation";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            return (int) $stmt->fetchColumn();
        }
    }
    public function getReservationRefuser()
    {
        $sql = "select count(*) from reservation where status = 'refuser'";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            return (int) $stmt->fetchColumn();
        }
    }
    public function getReservationattent()
    {
        $sql = "select count(*) from reservation where status = 'attent'";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            return (int) $stmt->fetchColumn();
        }
    }

    public function getReservationAccepter()
    {
        $sql = "select count(*) from reservation where status = 'accepter'";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            return (int) $stmt->fetchColumn();
        }
    }
}
