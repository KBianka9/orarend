<?php
include_once('./common/fuggvenyek.php');

$link = mysqli_connect("localhost", "admin", "123456789", "iskola");

if($link === false){
    die("ERROR: Sikertelen csatlakozás! " . mysqli_connect_error());
}

if((isset($_REQUEST['oktatottTargy']))) {
    $targy = $_REQUEST['oktatottTargy'];
    $tanarId = $_COOKIE['azonosito'];

    $stmt = mysqli_prepare($link, "INSERT INTO oktatotttargy(tanar_azonosito, oktatott_targy) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "is", $tanarId, $targy);
    mysqli_stmt_execute($stmt);
    header("Location: Tanarok_t.php");
}
mysqli_close($link);
