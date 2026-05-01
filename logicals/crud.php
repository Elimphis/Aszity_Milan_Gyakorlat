<?php

include(__DIR__ . '/../includes/config.inc.php');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' && isset($_POST['_method'])) {
    $override = strtoupper($_POST['_method']);

    if (in_array($override, ['PUT', 'PATCH', 'DELETE'])) {
        $method = $override;
    }
}


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

        $where = isset($_GET['id']) ? " id = " . $_GET['id'] : 1;

        try {

            $stmt = $dbh->prepare("SELECT * FROM filmek WHERE {$where} ORDER BY id ASC");

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

        $raw  = file_get_contents("php://input");
        $json = json_decode($raw, true);
        $data = is_array($json) ? $json : $_POST;

        $id    = $data['id'] ?? null;
        $cim   = $data['film_cim'] ?? null;
        $ev    = $data['film_ev'] ?? null;
        $hossz = $data['film_hossz'] ?? null;

        if (!$id || !$cim || !$ev || !$hossz) {
            $response = ['error' => 'Hiányzó adatok'];
            return;
        }
        
        try {

            $stmt = $dbh->prepare("
                UPDATE filmek 
                SET cim = :cim, ev = :ev, hossz = :hossz 
                WHERE id = :id
            ");

            if ($stmt->execute([
                ':id'    => $id,
                ':cim'   => $cim,
                ':ev'    => $ev,
                ':hossz' => $hossz
            ])) {

                header('Location: /crud');
                exit;

            } else {
                $response = ['error' => "Hiba történt a folyamat közben!"];
                return;
            }

        }
        catch (PDOException $e) {

            $response = ['error' => "Hiba történt a folyamat közben: " . $e->getMessage()];
            return;

        }  

    break;

    case 'DELETE':

        $raw  = file_get_contents("php://input");
        $json = json_decode($raw, true);
        $data = is_array($json) ? $json : $_POST;

        $id    = $data['id'] ?? null;

        if (!$id) {
            $response = ['error' => 'Hiányzó adatok'];
            return;
        }

        try {

            $stmt = $dbh->prepare("
                DELETE FROM filmek WHERE id = :id
            ");

            if ($stmt->execute([
                ':id'    => $id
            ])) {

                header('Location: /crud');
                exit;

            } else {
                $response = ['error' => "Hiba történt a folyamat közben!"];
                return;
            }

        }
        catch (PDOException $e) {

            $response = ['error' => "Hiba történt a folyamat közben: " . $e->getMessage()];
            return;

        }  

    break;

    default:
        return;
    break;

}