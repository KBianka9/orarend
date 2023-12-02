<?php
include_once 'dbConn.php';
include_once 'common/fuggvenyek.php';
$conn = OpenCon();
$user_data = check_login($conn);
if (!$user_data) {
    header("Location: Bejelentkezes.php");
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Órarend</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/icon_1.png">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
include_once "header.php";
navigacio("orarend_d");
?>
<main>
    <h1 style="padding-top: 10px">Órarendek</h1>
    <hr>
    <div style="margin-left: 450px">
        <div style="margin: 10px 0; display: inline-block">
            <form action="Orarend_d.php" method="POST">
                <label for="evfolyam">Osztály</label>
                <select id="evfolyam" style="margin-right: 2px" name="evfolyam">
                    <option value="">----</option>
                    <?php
                    $evfolyamok = mysqli_query($conn, "SELECT DISTINCT evfolyam FROM osztaly");
                    while ($egySor = mysqli_fetch_assoc($evfolyamok)) {
                        echo '<option value="' . $egySor["evfolyam"] . '">' . $egySor["evfolyam"] . '</option>';
                    }
                    mysqli_free_result($evfolyamok);
                    ?>
                </select>
                <label for="betujel"></label>
                <select id="betujel" style="margin-right: 2px" name="betujel">
                    <option value="">----</option>
                    <?php
                    $betujelek = mysqli_query($conn, "SELECT DISTINCT betujel FROM osztaly");
                    while ($egySor = mysqli_fetch_assoc($betujelek)) {
                        echo '<option value="' . $egySor["betujel"] . '">' . $egySor["betujel"] . '</option>';
                    }
                    mysqli_free_result($betujelek);
                    ?>
                </select>
                <input style="margin-left: 15px" type="submit" value="Keresés">
            </form>
        </div>
    </div>
    <br>
    <table style="padding-bottom: 20px">
        <tr>
            <th></th>
            <th>Hétfő</th>
            <th>Kedd</th>
            <th>Szerda</th>
            <th>Csütörtök</th>
            <th>Péntek</th>
        </tr>
        <?php
        $evfolyam = $_POST["evfolyam"] ?? "";
        $betujel = $_POST["betujel"] ?? "";

        $sql = "SELECT teremszam, ora, tanora_neve, nev FROM tanora, felhasznalo
                    WHERE tanar_azonosito = azonosito
                    AND tanora.evfolyam LIKE '$evfolyam'
                    AND tanora.betujel LIKE '$betujel'
                    ORDER BY ora";
        $res = mysqli_query($conn, $sql) or die ('Hiba!');
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo '<tr><th>' . $row["ora"] . '</th>
                <td>' . $row["tanora_neve"];
                echo "<br>" . $row["nev"];
                echo "<br>" . $row["teremszam"];
                echo ". terem" . '</td>
                <td>' . $row["tanora_neve"];
                echo "<br>" . $row["nev"];
                echo "<br>" . $row["teremszam"];
                echo ". terem" . '</td>
                <td>' . $row["tanora_neve"];
                echo "<br>" . $row["nev"];
                echo "<br>" . $row["teremszam"];
                echo ". terem" . '</td>
                <td>' . $row["tanora_neve"];
                echo "<br>" . $row["nev"];
                echo "<br>" . $row["teremszam"];
                echo ". terem" . '</td>
                <td>' . $row["tanora_neve"];
                echo "<br>" . $row["nev"];
                echo "<br>" . $row["teremszam"];
                echo ". terem" . '</td>
                </tr>';
            }
            echo '</table>';
        } else {
            echo "Válassz osztályt!";
        }
        CloseCon($conn);
        ?>
        <br><br>
</main>
</body>
</html>

