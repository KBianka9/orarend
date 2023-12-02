<?php
include_once('./common/fuggvenyek.php');

$link = mysqli_connect("localhost", "admin", "123456789", "iskola");

if($link === false){
    die("ERROR: Sikertelen csatlakozás! " . mysqli_connect_error());
}

if((isset($_REQUEST['new_class_year'])) && (isset($_REQUEST['new_class_grade'])) && (isset($_REQUEST['new_class_letter']))
    && (isset($_REQUEST['new_class_amount'])) && (isset($_REQUEST['new_class_department'])) && (isset($_REQUEST['of']))) {
    $cYear = $_REQUEST['new_class_year'];
    $cGrade =  $_REQUEST['new_class_grade'];
    $cLetter = $_REQUEST['new_class_letter'];
    $cAmount =  $_REQUEST['new_class_amount'];
    $cDepartment = $_REQUEST['new_class_department'];
    $of = $_REQUEST['of'];

    $stmt = mysqli_prepare($link, "INSERT INTO osztaly(kezdes_eve, evfolyam, betujel, letszam, tagozat) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iisis", $cYear, $cGrade, $cLetter, $cAmount, $cDepartment);
    mysqli_stmt_execute($stmt);
    $stmt2 = mysqli_prepare($link, "UPDATE felhasznalo SET kezdes_eve = ?, evfolyam = ?, betujel = ? WHERE azonosito = ?");
    mysqli_stmt_bind_param($stmt2, "iisi", $cYear, $cGrade, $cLetter, $of);
    mysqli_stmt_execute($stmt2);
    header("Location: Osztalyok_t.php");
}
mysqli_close($link);
