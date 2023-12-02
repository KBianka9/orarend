<?php
include_once 'dbConn.php';
include_once 'common/fuggvenyek.php';
$conn = OpenCon();
$user_data = check_login($conn);
if (!$user_data){
    header("Location: Bejelentkezes.php");
}
CloseCon($conn);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Terem</title>
    <link rel="icon" href="assets/img/icon_1.png"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>

    </style>
</head>
<body>
<?php
    include_once "header.php";
    navigacio("terem_d");
?>

<main>
    <h1 style="padding-top: 10px">Terem</h1>
    <hr>
    <h4>Összes terem</h4>
    <table>
        <tr>
            <th>Terem szám</th>
            <th>Férőhely</th>
            <th>Felszereltség</th>
        </tr>
        <?php
        $sql =
            "SELECT teremszam, ferohely, felszereltseg FROM terem";
        $res = mysqli_query($conn, $sql) or die ('Hiba!');
        while($rows = $res->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['teremszam'];?></td><td><?php echo $rows['ferohely'];?></td><td><?php echo $rows['felszereltseg'];?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br><br>
    <h4>Termek, amelyekben hetente több, mint 20 órát tartanak!</h4>
    <table style="padding-bottom: 40px">
        <tr>
            <th>Terem szám</th>
            <th>Órák száma</th>
        </tr>
        <tr>
            <td>217</td>
            <td>30</td>
        </tr>
        <tr>
            <td>222</td>
            <td>32</td>
        </tr>
        <tr>
            <td>215</td>
            <td>21</td>
        </tr>
        <tr>
            <td>300</td>
            <td>35</td>
        </tr>
    </table>
</main>
</body>
</html>
