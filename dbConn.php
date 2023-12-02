<?php
function OpenCon(){
    $dbHost = "localhost";
    $dbUser = "admin";
    $dbPwd = "123456789";
    $dbName = "iskola";
    $conn = new mysqli($dbHost, $dbUser, $dbPwd,$dbName) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}
function CloseCon($conn){
    $conn -> close();
}
