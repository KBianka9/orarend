<?php
include_once('./common/fuggvenyek.php');

$link = mysqli_connect("localhost", "admin", "123456789", "iskola");

if($link === false){
    die("ERROR: Sikertelen csatlakozás! " . mysqli_connect_error());
}

if((isset($_REQUEST['new_class_year'])) && (isset($_REQUEST['new_class_grade'])) && (isset($_REQUEST['new_class_letter'])) && (isset($_REQUEST['new_class_day']))
    && (isset($_REQUEST['new_class_clock'])) && (isset($_REQUEST['new_class_subject'])) && (isset($_REQUEST['new_class_teacher'])) && (isset($_REQUEST['new_class_number']))) {
    $cYear = $_REQUEST['new_class_year'];
    $cGrade =  $_REQUEST['new_class_grade'];
    $cLetter = $_REQUEST['new_class_letter'];
    $cDay =  $_REQUEST['new_class_day'];
    $cClock = $_REQUEST['new_class_clock'];
    $cSubject =  $_REQUEST['new_class_subject'];
    $cTeacher =  $_REQUEST['new_class_teacher'];
    $cNumber = $_REQUEST['new_class_number'];

    $cTeacherId = "SELECT azonosito FROM felhasznalo WHERE nev LIKE '$cTeacher'";

    $stmt = mysqli_prepare($link,
        "INSERT INTO tanora(tanar_azonosito, kezdes_eve, evfolyam, betujel, nap, ora, tanora_neve, teremszam) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iissssii", $cTeacherId, $cYear, $cGrade, $cLetter, $cDay, $cClock, $cSubject, $cNumber);
    mysqli_stmt_execute($stmt);
}
mysqli_close($link);
