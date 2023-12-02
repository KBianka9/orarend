<?php
    session_start();
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
    <title>Kezdőlap</title>
    <link rel="icon" href="assets/img/icon_1.png"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<?php
    include_once "header.php";
    navigacio("kezdolap");
?>
<main>
    <h1 style="padding-top: 10px">Üdvözöllek, <?php echo $user_data['nev'];?>!</h1>
    <hr>
    <p>Ez a felület azért jött létre, hogy megkönnyítse a diákok és tanárok életét több szempontot figyelembe véve:</p>
    <ul>
        <li>Követni tudják az órarendjüket.</li>
        <li>Teremekről, tanárokról, diákokról, osztályokról lehet információkat kapni.</li>
        <li>Tanár vagy admin jogosultsággal szerkeszthetik az adatokat.</li>
    </ul>
    <h3>Képernyőképek a használatról:</h3>
    <table style="border-width: 0; color: #505faf">
        <tr>
            <td style="background-color: #b7b4b4; text-align: left;">
                <img src="./assets/img/orarendScreen.png" alt="Órarend" width="800">
            </td>
            <td style="background-color: #b7b4b4; text-align: left;">
                <ol>
                    <li>Új óra felvitele a táblázatba (admin jogosultsággal rendelkezőknek):
                        <ul>
                            <li>Töltsd ki az üres mezőket</li>
                            <li>Hozzáadás a táblázathoz gomb megnyomása után lentebb frissül az órarend</li>
                        </ul>
                    </li><br>
                    <li>Adott osztály heti órarend keresője:
                        <ul>
                            <li>Válaszd ki a legördülő menükből az évfolyamot és a betűjelet</li>
                            <li>Keresés gomb megnyomása után lentebb megjelenik a kívánt órarend</li>
                        </ul>
                    </li>
                </ol>
            </td>
        </tr>
        <tr>
            <td style="background-color: #b7b4b4; text-align: left;">
                <img src="./assets/img/teremScreen.png" alt="Órarend" width="800">
            </td>
            <td style="background-color: #b7b4b4; text-align: left;">
                <ol>
                    <li>Terem módosító űrlap (tanár vagy admin jogosultsággal rendelkezőknek):</li>
                        <ul>
                            <li>Válaszd ki a legördülő menükből az teremszám és a felszereltséget</li>
                            <li>Módosítás gomb megnyomása után lentebb megjelenik a módosítás a táblázatban</li>
                        </ul>
                </ol>
            </td>
        </tr>
        <tr>
            <td style="background-color: #b7b4b4; text-align: left;">
                <img src="./assets/img/tanarScreen.png" alt="Órarend" width="800">
            </td>
            <td style="background-color: #b7b4b4; text-align: left;">
                <ol>
                    <li>Oktatott tárgy hozzáadás (csak tanár jogosultsággal rendelkezőknek):</li>
                    <ul>
                        <li>Töltsd ki az üres mező</li>
                        <li>Mentés gomb megnyomása után elmenti az adatbázisban</li>
                    </ul>
                </ol>
            </td>
        </tr>
        <tr>
            <td style="background-color: #b7b4b4; text-align: left;">
                <img src="./assets/img/osztalyScreen.png" alt="Órarend" width="800">
            </td>
            <td style="background-color: #b7b4b4; text-align: left;">
                <ol>
                    <li>Új osztály felvétele űrlap (tanár vagy admin jogosultsággal rendelkezőknek):</li>
                    <ul>
                        <li>Töltsd ki az üres mezőket</li>
                        <li>Hozzáadás a táblázathoz gomb megnyomása után lentebb frissül a táblázat</li>
                    </ul><br>
                    <li>Osztály törlése űrlap (tanár vagy admin jogosultsággal rendelkezőknek):</li>
                    <ul>
                        <li>Válaszd ki a legördülő menükből a kezdés évét, az évfolyamot és a betűjelet</li>
                        <li>Törlés a táblázatból gomb megnyomása után lentebb frissül a táblázat</li>
                    </ul>
                </ol>
            </td>
        </tr>
    </table>
</main>
</body>
</html>
