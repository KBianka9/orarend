<?php
include_once 'dbConn.php';
include_once "common/fuggvenyek.php";
session_start();
$conn = OpenCon();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
    <link rel="icon" href="assets/img/icon_1.png"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body class="bodykezdolap">
    <section id="be">
        <?php
        if (isset($_POST['login_btn'])){
            $email_signin = $_POST['email_signin'];
            $password_signin = $_POST['password_signin'];

            if (!empty($email_signin) && !empty($password_signin)){
                $hashed_password = md5($password_signin);
                $query = "SELECT azonosito, jogosultsag FROM felhasznalo WHERE email ='$email_signin' AND jelszo ='$hashed_password'";
                $result = mysqli_query($conn, $query) or die("Lekérdezési hiba történt");
                $row = mysqli_fetch_assoc($result);

                if (is_null($row)){
                    echo "<div class='fail' style='margin-top: 60px; rotate: -8deg'><p>Helytelen név vagy jelszó</p></div>";
                    echo "<div class='fail' style='margin-top: 10px; rotate: -8deg; font-size: x-large'><p>Sikertelen bejelentkezés!</p></div>";
                    echo "<a href='javascript:self.history.back()'><button class='gomb' style='margin-left: 750px; margin-top: 50px; rotate: -8deg'>Vissza</button>";
                }else{
                    setcookie("azonosito", $row["azonosito"]);
                    setcookie("jogosultsag", $row["jogosultsag"]);
                    echo "<div class='success' style='margin-top: 50px; rotate: -8deg'><p>Sikeres bejelentkezés!</p></div>";
                    echo "<a href='Kezdolap.php'><button class='gombB' style='margin-left: 725px; rotate: -8deg'>Belépés</button>";
                }
            }
        }else{
        ?>
        <form class="formbej" method="POST" action="Bejelentkezes.php">
            <fieldset style="border: none; align-items: center; padding-left: 100px; rotate: -8deg">
                <h1 style="margin-left: -6px; font-size: xx-large">Bejelentkezés</h1>
                <img src="assets/img/default.png" style="width: 200px; height: 200px; padding-bottom: 10px; margin-left: -10px" alt="Profilkép"><br>
                <label for="email_signin"></label><input type="email" name="email_signin" title="Töltsd ki a mezőt! pl.: mintandris@gmail.com" placeholder="Email cím" required><br>
                <label for="password_signin"></label><input type="password" name="password_signin" title="Töltsd ki a mezőt! pl.: jelszó" placeholder="Jelszó" required>
            </fieldset>
            <div style="flex-direction: row; padding-left: 80px; margin-top: -10px; rotate: -8deg">
                <input type="reset" name="reset_btn" value="Adatok törlése"/>
                <input type="submit" name="login_btn" value="Bejelentkezés" required/>
                <p style="font-size: 13px; padding-left: 60px">Nem vagy még regisztrálva?  <a href="Regiszt.php">Katt ide</a></p>
            </div>
        </form>
        <?php } ?>
    </section>
</body>
</html>
