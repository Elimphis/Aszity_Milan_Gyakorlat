<?php

include(__DIR__ . '/../includes/config.inc.php');

$method = $_SERVER['REQUEST_METHOD'];

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



switch ($method) {

    case 'GET':

        try {

            $stmt = $dbh->prepare("SELECT * FROM filmek ORDER BY id ASC");

            if($stmt->execute()) {
                
                $response =['data' => $stmt->fetchAll()];
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

    break;

    case 'POST':

    break;

    case 'PUT':

    break;

    case 'DELETE':

    break;

    default:
        return;
    break;

}