<?php
include_once 'dbConn.php';
include_once 'common/fuggvenyek.php';
$conn = OpenCon();
$user_data = check_login($conn);
if (!$user_data){
    header("Location: Bejelentkezes.php");
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Osztályok</title>
    <link rel="icon" href="assets/img/icon_1.png"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>

    </style>
</head>
<body>
<?php
include_once "header.php";
navigacio("osztalyok_t");
?>

<main>
    <h1 style="padding-top: 10px">Osztályok</h1>
    <hr>
    <div style="align-items: center">
        <div style="margin: 0 40px; display: inline-block">
            <form action="osztalyHozzaad.php" method="POST" >
                <h4>Új osztály felvétele</h4>
                <label for="new_class_year">Kezdés éve</label>
                <input type="text" id="new_class_year" name="new_class_year"><br>
                <label for="new_class_grade">Évfolyam</label>
                <input type="text" id="new_class_grade" name="new_class_grade" style="margin-left: 15px"><br>
                <label for="new_class_letter">Betűjel</label>
                <input type="text" id="new_class_letter" name="new_class_letter" style="margin-left: 30px"><br>
                <label for="new_class_amount">Létszám</label>
                <input type="text" id="new_class_amount" name="new_class_amount" style="margin-left: 20px"><br>
                <label for="new_class_department">Tagozat</label>
                <input type="text" id="new_class_department" name="new_class_department" style="margin-left: 25px"><br>
                <label for="of">Osztályfőnök</label>
                <select id="of" style="padding-left: 10px; width: 165px" name="of">
                    <option value="">-----------------------------</option>
                    <?php
                    $osztalyf = mysqli_query( $conn, "SELECT nev, azonosito FROM felhasznalo WHERE kezdes_eve IS NULL AND jogosultsag LIKE 'tanár'");
                    while( $egySor = mysqli_fetch_assoc($osztalyf) ) {
                        echo '<option value="'. $egySor["azonosito"] .'">'. $egySor["nev"] .'</option>';
                    }
                    mysqli_free_result($osztalyf);
                    ?>
                </select><br>
                <input style="margin-left: 15px" type="submit" value="Hozzáadás a táblázathoz">
            </form>
        </div>
        <div style="margin: 0 40px; display: inline-block">
            <form action="osztalyTorol.php" method="POST">
                <h4>Osztály törlése</h4>
                <label for="del_class_year">Kezdés éve</label>
                <select id="del_class_year" style="margin-left: 15px; padding-left: 30px; width: 105px;" name="del_class_year">
                    <option value="">----</option>
                    <?php
                    $kezd = mysqli_query( $conn, "SELECT DISTINCT kezdes_eve FROM osztaly");
                    while( $egySor = mysqli_fetch_assoc($kezd) ) {
                        echo '<option value="'. $egySor["kezdes_eve"] . '">'.$egySor["kezdes_eve"].'</option>';
                    }
                    mysqli_free_result($kezd);
                    ?>
                </select><br>
                <label for="del_class_grade">Évfolyam</label>
                <select id="del_class_grade" style="margin-left: 30px; padding-left: 35px; width: 105px;" name="del_class_grade">
                    <option value="">----</option>
                    <?php
                    $evf = mysqli_query( $conn, "SELECT DISTINCT evfolyam FROM osztaly");
                    while( $egySor = mysqli_fetch_assoc($evf) ) {
                        echo '<option value="'. $egySor["evfolyam"] . '">'.$egySor["evfolyam"].'</option>';
                    }
                    mysqli_free_result($evf);
                    ?>
                </select><br>
                <label for="del_class_letter">Betűjel</label>
                <select id="del_class_letter" style="margin-left: 40px; padding-left: 45px; width: 108px;" name="del_class_letter">
                    <option value="">----</option>
                    <?php
                    $betu = mysqli_query( $conn, "SELECT DISTINCT betujel FROM osztaly");
                    while( $egySor = mysqli_fetch_assoc($betu) ) {
                        echo '<option value="'. $egySor["betujel"] . '">'.$egySor["betujel"].'</option>';
                    }
                    mysqli_free_result($betu);
                    ?>
                </select><br>
                <input style="margin-left: 15px" type="submit" value="Törlés a táblázatból">
            </form>
        </div>
    </div>
    <h4>Összes osztály</h4>
    <table>
        <tr>
            <th>Kezdés éve</th>
            <th>Évfolyam</th>
            <th>Betűjel</th>
            <th>Létszám</th>
            <th>Tagozat</th>
            <th>Osztályfőnök</th>
        </tr>
        <?php
        $sql = "SELECT nev AS osztalyfonok, osztaly.evfolyam, osztaly.betujel, osztaly.kezdes_eve, letszam, tagozat FROM osztaly, felhasznalo
                    WHERE  osztaly.kezdes_eve = felhasznalo.kezdes_eve
                    AND osztaly.evfolyam = felhasznalo.evfolyam
                    AND osztaly.betujel = felhasznalo.betujel
                    AND jogosultsag LIKE 'tanár'
                    AND felhasznalo.kezdes_eve IS NOT NULL
                    AND letszam = (SELECT COUNT(nev) FROM osztaly, felhasznalo WHERE  osztaly.kezdes_eve = felhasznalo.kezdes_eve
                    AND osztaly.evfolyam = felhasznalo.evfolyam
                    AND osztaly.betujel = felhasznalo.betujel
                    AND jogosultsag LIKE 'diák')
                    ORDER BY letszam DESC";
        $res = mysqli_query($conn, $sql) or die ('Hiba!');
        while($rows = $res->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['kezdes_eve'];?></td><td><?php echo $rows['evfolyam'];?></td><td><?php echo $rows['betujel'];?></td><td><?php echo $rows['letszam'];?></td><td><?php echo $rows['tagozat'];?></td><td><?php echo $rows['osztalyfonok'];?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <h4>Egyes osztályok, osztályfőnökeik nevei és oktatott tárgyai! A listázásnál az osztályok évfolyamuk és betűjelük szerint növekvő szám ill. ABC-sorrendbe!</h4>
    <table>
        <tr>
            <th>Kezdés éve</th>
            <th>Osztály</th>
            <th>Osztályfőnök</th>
            <th>Oktatott tantárgy(ai)</th>
        </tr>
        <?php
        $sql2 = "SELECT azonosito, kezdes_eve, evfolyam, betujel, nev AS osztalyfonok, oktatott_targy 
                    FROM felhasznalo, oktatotttargy 
                    WHERE azonosito = tanar_azonosito
                    AND kezdes_eve IS NOT NULL
                    ORDER BY evfolyam, betujel";
        $res2 = mysqli_query($conn, $sql2) or die ('Hiba!');
        $result = [];
        $classesByTeacher = [];
        while($rows = $res2->fetch_assoc()) {
            $result[$rows['azonosito']] = $rows;
            if (!isset($classesByTeacher[$rows['azonosito']])){
                $classesByTeacher[$rows['azonosito']] = [];
            }
            $classesByTeacher[$rows['azonosito']][] = $rows['oktatott_targy'];
        }
        CloseCon($conn);
        foreach ($result as $id=>$teacher){
            ?>
            <tr>
                <td><?php echo $teacher['kezdes_eve'];?></td>
                <td><?php echo $teacher['evfolyam']; echo "/"; echo $teacher['betujel'];?></td>
                <td><?php echo $teacher['osztalyfonok'];?></td>
                <td><?php echo implode( ', ', $classesByTeacher[$id]);?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
</main>
</body>
</html>
