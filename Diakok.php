<?php
include 'dbConn.php';
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
    <title>Diákok</title>
    <link rel="icon" href="assets/img/icon_1.png"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>

    </style>
</head>
<body>
<?php
    include_once "header.php";
    navigacio("diakok");
?>

<main>
    <h1 style="padding-top: 10px">Diákok</h1>
    <hr>
    <table>
        <tr>
            <th>Kezdés éve</th>
            <th>Osztály</th>
            <th>Név</th>
            <th>Email</th>
            <th>Telefon szám</th>
        </tr>
        <?php
        $sql = "SELECT nev, email, telefon, evfolyam, betujel, kezdes_eve, jogosultsag FROM felhasznalo
                       WHERE jogosultsag LIKE 'diák' 
                       ORDER BY kezdes_eve DESC, evfolyam";
        $res = mysqli_query($conn, $sql) or die ('Hiba!');
        while($rows = $res->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['kezdes_eve'];?></td><td><?php echo $rows['evfolyam']; echo "/"; echo $rows['betujel'];?></td><td><?php echo $rows['nev'];?></td><td><?php echo $rows['email'];?></td><td><?php echo ($rows['telefon'] != 0) ? $rows['telefon'] :  " " ?></td>
            </tr>
            <?php
        }
        CloseCon($conn);
        ?>
    </table>
    <br>
</main>
</body>
</html>
