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
    navigacio("osztalyok_d");
?>

<main>
    <h1 style="padding-top: 10px">Osztályok</h1>
    <hr>
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
    <table style="padding-bottom: 20px;">
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
