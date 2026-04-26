<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include(__DIR__ . '/../includes/config.inc.php');

$method   = $_SERVER['REQUEST_METHOD']; if ($method !== "GET") return;
$response = [];

// Kapcsolódás az adatbazishoz
    try {
        $dbh = new PDO("mysql:host={$adatbazis['host']};dbname={$adatbazis['dbname']}", $adatbazis['username'], $adatbazis['password'],
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
    }
    catch (PDOException $e) {

        $response = ['error' => $e->getMessage()];
        return;

    }  


//Adatok lekerdezese
    try {

        $stmt = $dbh->prepare("SELECT * FROM kapcsolat ORDER BY bekuldve DESC");

        if($stmt->execute()) {
            
            $response = ['data' => $stmt->fetchAll()];
            return;

        }
        else {
            $response = ['error' => "Hiba történt a folyamat közben!"]; 
            return;  
        }

    }
    catch (PDOException $e) {

        $response = ['error' => "Hiba történt a folyamat közben: " . $e->getMessage()];
        return;

    }  