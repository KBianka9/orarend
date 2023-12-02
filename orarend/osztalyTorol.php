<?php

$link = mysqli_connect("localhost", "admin", "123456789", "iskola");

if($link === false){
    die("ERROR: Sikertelen csatlakozás! " . mysqli_connect_error());
}

if((isset($_REQUEST['del_class_year'])) && (isset($_REQUEST['del_class_grade'])) && (isset($_REQUEST['del_class_letter']))) {
    $dYear = $_REQUEST['del_class_year'];
    $dGrade =  $_REQUEST['del_class_grade'];
    $dLetter = $_REQUEST['del_class_letter'];

    $sql = mysqli_prepare($link,
        "DELETE FROM osztaly WHERE kezdes_eve = ? AND evfolyam = ? AND betujel = ?");
    mysqli_stmt_bind_param($sql, "iis", $dYear, $dGrade, $dLetter);
    if ( mysqli_stmt_execute($sql) ) {
        header("Location: Osztalyok_t.php");
    } else {
        echo "ERROR: Sikertelen törlés: $sql. "
            . mysqli_error($link);
    }
}
mysqli_close($link);
