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
    <title>Terem</title>
    <link rel="icon" href="assets/img/icon_1.png"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>

    </style>
</head>
<body>
<?php
    include_once "header.php";
    navigacio("terem_t");
?>

<main>
    <h1 style="padding-top: 10px">Terem</h1>
    <hr>
    <h4>Terem felszereltségének módosítsa</h4>
    <form action="teremModosit.php" method="POST">
        <label for="class_number">Terem szám</label>
        <select id="class_number" style="margin-left: 30px; width: 125px" name="class_number">
            <option value="">--Válassz--</option>
            <?php
            $termek = mysqli_query( $conn, "SELECT teremszam FROM terem")or die ('Hiba!');
            while( $egySor = mysqli_fetch_assoc($termek) ) {
                echo '<option value="'. $egySor["teremszam"] . '">'.$egySor["teremszam"].'</option>';
            }
            mysqli_free_result($termek);
            ?>
        </select><br>
        <label for="class_equip">Felszereltség</label>
        <select id="class_equip" style="margin-left: 20px" name="class_equip">
            <option value="">--Válassz--</option>
            <?php
            $felszereltseg = mysqli_query( $conn, "SELECT DISTINCT felszereltseg FROM terem");
            while( $egySor = mysqli_fetch_assoc($felszereltseg) ) {
                echo '<option value="'. $egySor["felszereltseg"] . '">'.$egySor["felszereltseg"].'</option>';
            }
            mysqli_free_result($felszereltseg);
            ?>
        </select><br>
        <input style="margin-left: 50px; margin-top: 10px;" type="submit" value="Módosítás">
    </form>
    <h4>Összes terem</h4>
    <table>
        <tr>
            <th>Terem szám</th>
            <th>Férőhely</th>
            <th>Felszereltség</th>
        </tr>
        <?php
        $sql = "SELECT teremszam, ferohely, felszereltseg FROM terem";
        $res = mysqli_query($conn, $sql) or die ('Hiba!');
        while($rows = $res->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['teremszam'];?></td><td><?php echo $rows['ferohely'];?></td><td><?php echo $rows['felszereltseg'];?></td>
            </tr>
            <?php
        }
        CloseCon($conn);
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
