<?php

include(__DIR__ . '/../includes/config.inc.php');

$method = $_SERVER['REQUEST_METHOD'];


// Kapcsolódás az adatbazishoz
    try {
        $dsn = "mysql:host={$adatbazis['host']};dbname={$adatbazis['dbname']}";
        $dbh = new PDO($dsn, $adatbazis['username'], $adatbazis['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $dbh->exec("SET NAMES utf8 COLLATE utf8_hungarian_ci");
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

        $raw  = file_get_contents("php://input");
        $json = json_decode($raw, true);
        $data = is_array($json) ? $json : $_POST;

        $cim   = $data['film_cim'] ?? null;
        $ev    = $data['film_ev'] ?? null;
        $hossz = $data['film_hossz'] ?? null;

        if (!$cim || !$ev || !$hossz) {
            $response = ['error' => 'Hiányzó adatok'];
            return;
        }
        
        try {

            $stmt = $dbh->prepare("INSERT INTO filmek (cim, ev, hossz) VALUES (:cim, :ev, :hossz)");

            if($stmt->execute(array(':cim' => $cim, ':ev' => $ev, ':hossz' => $hossz))) {
            
                header('Location: /crud');
                exit;

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

    case 'PUT':

    break;

    case 'DELETE':

    break;

    default:
        return;
    break;

}