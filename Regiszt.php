<?php
include_once 'dbConn.php';
include_once "common/fuggvenyek.php";
session_start();
$conn = OpenCon();
$sql =
    "SELECT kezdes_eve, evfolyam, betujel FROM osztaly";
$res = mysqli_query($conn, $sql) or die ('Hiba!');
$sql2 =
    "SELECT tanar_azonosito, oktatott_targy FROM oktatotttargy";
$res2 = mysqli_query($conn, $sql2) or die ('Hiba!');
$sql3 =
    "SELECT DISTINCT jogosultsag FROM felhasznalo";
$res3 = mysqli_query($conn, $sql3) or die ('Hiba!');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
    <link rel="icon" href="assets/img/icon_1.png"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body class="bodykezdolap">
<section id="be">
    <?php
    if (isset($_POST['signup_btn'])) {
        $fullName = $_POST['full_name'];
        $password = $_POST['password'];
        $confPassword = $_POST['conf_password'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $permission = $_POST['permission'];
        $osztaly = $_POST['osztaly'];

        $errors = 0;

        $verify_query = mysqli_query($conn, "SELECT email FROM felhasznalo WHERE email='$email'");

        echo "<div style='margin-top: 70px'></div>";
        if (mysqli_num_rows($verify_query) != 0) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>Ezzel az email címmel már regisztráltak, írj be másikat</p></div>";
        }
        if (!$fullName) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>A név megadása kötelező!</p></div>";
        } elseif (strlen($fullName) < 5 || strlen($fullName) > 30) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>A név 5-30 karakterből állhat!</p></div>";
        }
        if (!$password) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>A jelszó megadása kötelező!</p></div>";
        } elseif (strlen($password) < 8 || strlen($password) > 20) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>A jelszó 8-20 karakterből állhat!</p></div>";
        }
        if (!$confPassword) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>A jelszó megrősítés megadása kötelező!</p></div>";
        } elseif ($password !== $confPassword) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>A két jelszó nem egyezik meg!</p></div>";
        }
        if (!$email) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>Az email megadása kötelező!</p></div>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>Az email formátuma nem megfelelő!</p></div>";
        }
        if (!$permission) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>A jogosultság megadása kötelező!</p></div>";
        } elseif (!in_array($permission, ["diák", "admin", "tanár"])) {
            $errors += 1;
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg'><p>A jogosultság tanár, diák vagy admin érték lehet!</p></div>";
        }if ($errors > 0) {
            echo "<div class='fail' style='margin-top: 10px; rotate: -8deg; font-size: x-large'><p>Sikertelen regisztráció!</p></div>";
            echo "<a href='javascript:self.history.back()'><button class='gomb' style='margin-left: 750px; margin-top: 50px; rotate: -8deg'>Vissza</button>";
        } elseif ($errors === 0) {
            $hashed_password = md5($password);
            [$kezdes_eve, $evfolyam, $betujel] = $osztaly ? explode(";", $osztaly) : [null, null, null];
            $query = "INSERT INTO felhasznalo(jogosultsag, nev, jelszo, email, telefon, kezdes_eve, evfolyam, betujel) 
                    VALUES (
                            '$permission',
                            '$fullName',
                            '$hashed_password',
                            '$email',
                            '$tel', " .
                            (!is_null($kezdes_eve) ? "'$kezdes_eve'" : "NULL") . ", " .
                            (!is_null($evfolyam) ? "'$evfolyam'" : "NULL") . ", " .
                            (!is_null($betujel) ? "'$betujel'" : "NULL") .
                            ")";
            mysqli_query($conn, $query) or die("Hiba történt");
            echo "<div class='success' style='margin-top: 50px; rotate: -8deg'><p>Sikeres regisztráció!</p></div>";
            echo "<a href='Bejelentkezes.php'><button class='gombB' style='margin-left: 700px; rotate: -8deg'>Bejelentkezés</button>";
        }
    } else {
        ?>
        <form class="formbej" method="POST" action="Regiszt.php">
            <fieldset style="border: none; align-items: center; padding-left: 100px; rotate: -8deg">
                <h1 style="margin-left: 7px; font-size: xx-large">Regisztráció</h1>
                <label for="full_name"></label>
                <input type="text" name="full_name" title="Töltsd ki a mezőt! pl.: Minta András" autocomplete="off"
                       placeholder="Teljes név" required><br>
                <label for="password"></label>
                <input type="password" name="password" title="Töltsd ki a mezőt! pl.: jelszó" autocomplete="off"
                       placeholder="Jelszó" required><br>
                <label for="conf_password"></label>
                <input type="password" name="conf_password" title="Töltsd ki a mezőt! pl.: jelszó" autocomplete="off"
                       placeholder="Jelszó megerősítése" required><br>
                <label for="email"></label>
                <input type="email" name="email" title="Töltsd ki a mezőt! pl.: mintandris@gmail.com" autocomplete="off"
                       placeholder="Email" required><br>
                <label for="tel"></label>
                <input type="tel" name="tel" title="Töltsd ki a mezőt! pl.: 30 157 1257" autocomplete="off"
                       placeholder="Telefon szám"><br>
                <label for="permission">
                    <select name="permission" style="width: 180px" required>
                        <?php
                        while ($rows = $res3->fetch_assoc()) {
                            ?>
                            <option value="<?= $rows['jogosultsag']?>">
                                <?= $rows['jogosultsag']?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </label><br>
                <label for="osztaly">
                    <select name="osztaly" style="width: 180px">
                        <option value="">Osztály választása</option>
                        <?php
                        while ($rows = $res->fetch_assoc()) {
                            ?>
                            <option value="<?= $rows['kezdes_eve'] . ";" . $rows['evfolyam'] . ";" . $rows['betujel'] ?>">
                                <?= $rows['kezdes_eve'] . " " . $rows['evfolyam'] . "/" . $rows['betujel'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </label>
            </fieldset>
            <div style="flex-direction: row; padding-left: 80px; margin-top: -30px; rotate: -9deg">
                <input type="reset" name="reset_btn" value="Adatok törlése"/>
                <input type="submit" name="signup_btn" value="Regisztráció" required/>
                <p style="font-size: 13px; padding-left: 60px">Regisztráltál már? <a href="Bejelentkezes.php">Katt ide</a></p>
            </div>
        </form>
    <?php } ?>
</section>
</body>
</html>
