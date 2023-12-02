<?php
include_once('./common/fuggvenyek.php');

$link = mysqli_connect("localhost", "admin", "123456789", "iskola");

if($link === false){
    die("ERROR: Sikertelen csatlakozás! " . mysqli_connect_error());
}

if((isset($_REQUEST['class_number'])) && (isset($_REQUEST['class_equip']))) {
    $cNum = $_REQUEST['class_number'];
    $cEq =  $_REQUEST['class_equip'];

    $sql =
        "UPDATE terem SET felszereltseg = '$cEq' WHERE teremszam = '$cNum'";
    if (mysqli_query($link, $sql)) {
        header("Location: Terem_t.php");
    } else {
        echo "ERROR: Sikertelen módosítás: $sql. "
            . mysqli_error($link);
    }
}
mysqli_close($link);
