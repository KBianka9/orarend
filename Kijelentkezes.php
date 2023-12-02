<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kijelentkezés</title>
    <link rel="icon" href="assets/img/icon_1.png"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<?php
session_start();

session_unset();
session_destroy();

echo "<div class='success' style='margin-top: 50px; rotate: -8deg'><p>Sikeres kijelentkezés!</p></div>";
echo "<a href='Bejelentkezes.php'><button class='gombB' style='margin-left: 700px; rotate: -8deg'>Bejelentkezés</button>";
?>
</body>
</html>
