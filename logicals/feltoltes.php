<?php

include('./includes/config.inc.php');


// UUID Generator
function guidv4($data = null) {

    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}


$target_dir     = $uploads['target'];
$target_file    = $target_dir . basename($_FILES["imageUpload"]["name"]);
$uploadOk       = 1;
$imageFileType  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Feltoltott allomany tipusanak ellenorzese
if(isset($_POST["submit"])) {

    $check = getimagesize($_FILES["imageUpload"]["tmp_name"]);

    if($check !== false) {

        $uploadOk = 1;

    } else {

        $errormessage   = "Hiba: A feltöltött állomány nem egy kép!";
        return;

    }

}

$generatedFile = $target_dir . '' . guidv4() . "." . $imageFileType;

// Duplikacio ellenorzese
if (file_exists($generatedFile)) {

  $errormessage = "Hiba: A feltöltött kép már létezik!";
  return;

}


// Fajl meretenek ellenorzese
if ($_FILES["imageUpload"]["size"] > $uploads['size']) {

    $errormessage = "Hiba: A kép mérete túl nagy!";
    return;

}


// Fajl kiterjesztesenek korlatozasa
if(!in_array($imageFileType, $uploads['mimes'])) {

    $errormessage   = "Hiba: Nem támogatott fájl kiterjesztés! (Engedélyezett: jpg, jpeg, png, gif)";
    return;

}


// Kep feltoltese
if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $generatedFile)) {

    $successMessage = "Kép feltöltése sikeresen megtörtént!";

} else {

    $errormessage = "Hiba: A kép feltöltése sikertelen volt!";
    return;

}