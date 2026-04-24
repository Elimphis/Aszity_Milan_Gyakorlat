<?php

include(__DIR__ . '/../includes/config.inc.php');

$method = $_SERVER['REQUEST_METHOD']; if ($method !== "POST") return;
$data   = json_decode(file_get_contents("php://input"), true) ?? $_POST;


// Adatok validalasa
    if (!isset($data['nev'])) {
        
        echo json_encode(['error' => "Teljes Név mező kitöltése kötelező!"]);
        return;

    }

    if (!isset($data['szoveg'])) {
        
        echo json_encode(['error' => "Szöveg mező kitöltése kötelező!"]);
        return;

    }

// Kapcsolódás az adatbazishoz
    try {
        $dbh = new PDO("mysql:host={$adatbazis['host']};dbname={$adatbazis['dbname']}", $adatbazis['username'], $adatbazis['password'],
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
    }
    catch (PDOException $e) {

        echo json_encode(['error' => $e->getMessage()]);
        return;

    }  


// Adatok mentese

    try {

        $stmt = $dbh->prepare("
            INSERT INTO kapcsolat
            (nev, szoveg) VALUES
            (:nev, :szoveg)
        ");

        if($stmt->execute(array(':nev' => $data['szoveg'], ':szoveg' => $data['szoveg']))) {
            
            echo json_encode(['success' => true]);
            return;

        }
        else {
            echo json_encode(['error' => "Hiba történt a folyamat közben!"]);  
            return;  
        }

    }
    catch (PDOException $e) {

        echo json_encode(['error' => "Hiba történt a folyamat közben: " . $e->getMessage()]);
        return;

    }  
