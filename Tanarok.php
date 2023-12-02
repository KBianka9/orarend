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
    <title>Tanárok</title>
    <link rel="icon" href="assets/img/icon_1.png"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<?php
    include_once "header.php";
    navigacio("tanarok");
?>

<main>
    <h1 style="padding-top: 10px">Tanárok</h1>
    <hr>
    <h4>Egy-egy tantárgyat hányan tanítanak?</h4>
    <br>
    <?php
    $link = mysqli_connect("localhost", "admin", "123456789", "iskola");

    if($link === false){
        die("ERROR: Sikertelen csatlakozás! " . mysqli_connect_error());
    }
    $sql = "SELECT oktatott_targy, COUNT(nev) AS darab FROM felhasznalo, oktatotttargy 
                                  WHERE azonosito = tanar_azonosito
                                    GROUP BY oktatott_targy";

        if($result = mysqli_query($link, $sql)){
            echo "<table>";
            echo "<tr>";
            echo "<th>Oktatott tárgy</th>";
            echo "<th>Oktatók száma</th>";
            echo "</tr>";
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['oktatott_targy'] . "</td>";
                    echo "<td>" . $row['darab'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            mysqli_free_result($result);
        } else{
            echo "ERROR: $sql. " . mysqli_error($link);
        }
    mysqli_close($link);
    ?>
    <br><br>
    <h2>Összes tanár</h2>
    <table style="padding-bottom: 20px;">
        <tr>
            <th>Név</th>
            <th>Email</th>
            <th>Telefon szám</th>
            <th>Oktatott tantárgy(ak)</th>
            <th>Osztályfőnök</th>
        </tr>
    <?php
    $sql3 = "SELECT azonosito, nev, email, telefon, oktatott_targy, evfolyam, betujel FROM felhasznalo, oktatotttargy WHERE azonosito = tanar_azonosito";

    $res2 = mysqli_query($conn, $sql3) or die ('Hiba!');
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
            <td><?php echo $teacher['nev'];?></td>
            <td><?php echo $teacher['email'];?></td>
            <td><?php echo ($teacher['telefon'] != 0) ? $teacher['telefon'] : " "?></td>
            <td><?php echo implode( ', ', $classesByTeacher[$id]);?></td>
            <td><?php echo ($teacher['evfolyam'] != null) ? $teacher['evfolyam'] . "/" . $teacher['betujel'] : '-'?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <br>
</main>
</body>
</html>
