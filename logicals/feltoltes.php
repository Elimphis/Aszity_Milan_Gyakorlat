<?php

include('./includes/config.inc.php');

$target_dir     = "images/uploads/";
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


// Duplikacio ellenorzese
if (file_exists($target_file)) {

  $errormessage = "Hiba: A feltöltött kép már létezik!";
  return;

}


// Fajl meretenek ellenorzese
if ($_FILES["imageUpload"]["size"] > 1000000) {

    $errormessage = "Hiba: A kép mérete túl nagy!";
    return;

}


// Fajl kiterjesztesenek korlatozasa
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {

    $errormessage   = "Hiba: Nem támogatott fájl kiterjesztés! (Engedélyezett: jpg, jpeg, png, gif)";
    return;

}


// Kep feltoltese
if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {

    $successMessage = "Kép feltöltése sikeresen megtörtént!";

} else {

    $errormessage = "Hiba: A kép feltöltése sikertelen volt!";
    return;

}