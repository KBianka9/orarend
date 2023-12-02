<?php

function navigacio(string $aktualisOldal){
    echo "<nav><ul>" .
        "<li" . ($aktualisOldal === "kezdolap" ? " class='active'" : "") . ">" .
        "<a href='Kezdolap.php'>Kezdőlap</a>" .
        "</li>";
    if (isset($_COOKIE["jogosultsag"]) && isset($_COOKIE["azonosito"])){
        if ($_COOKIE["jogosultsag"] === "diák") {
            echo
                "<li" . ($aktualisOldal === "orarend_d" ? " class='active'" : "") . ">" .
                "<a href='Orarend_d.php'>Órarend</a>" .
                "</li>" .
                "<li" . ($aktualisOldal === "terem_d" ? " class='active'" : "") . ">" .
                "<a href='Terem_d.php'>Terem</a>" .
                "</li>" .
                "<li" . ($aktualisOldal === "tanarok" ? " class='active'" : "") . ">" .
                "<a href='Tanarok.php'>Tanárok</a>" .
                "</li>" .
                "<li" . ($aktualisOldal === "osztalyok_d" ? " class='active'" : "") . ">" .
                "<a href='Osztalyok_d.php'>Osztályok</a>" .
                "</li>";
        }
        elseif ($_COOKIE["jogosultsag"] === "admin") {
            echo
                "<li" . ($aktualisOldal === "orarend_t" ? " class='active'" : "") . ">" .
                "<a href='Orarend_t.php'>Órarend</a>" .
                "</li>" .
                "<li" . ($aktualisOldal === "terem_t" ? " class='active'" : "") . ">" .
                "<a href='Terem_t.php'>Terem</a>" .
                "</li>" .
                "<li" . ($aktualisOldal === "tanarok" ? " class='active'" : "") . ">" .
                "<a href='Tanarok.php'>Tanárok</a>" .
                "</li>" .
                "<li" . ($aktualisOldal === "osztalyok_t" ? " class='active'" : "") . ">" .
                "<a href='Osztalyok_t.php'>Osztályok</a>" .
                "</li>";
        }
        elseif ($_COOKIE["jogosultsag"] === "tanár") {
            echo
                "<li" . ($aktualisOldal === "orarend_d" ? " class='active'" : "") . ">" .
                "<a href='Orarend_d.php'>Órarend</a>" .
                "</li>" .
                "<li" . ($aktualisOldal === "terem_t" ? " class='active'" : "") . ">" .
                "<a href='Terem_t.php'>Terem</a>" .
                "</li>" .
                "<li" . ($aktualisOldal === "tanarok_t" ? " class='active'" : "") . ">" .
                "<a href='Tanarok_t.php'>Tanárok</a>" .
                "</li>" .
                "<li" . ($aktualisOldal === "osztalyok_t" ? " class='active'" : "") . ">" .
                "<a href='Osztalyok_t.php'>Osztályok</a>" .
                "</li>";
        }
    }
    echo
        "<li" . ($aktualisOldal === "diakok" ? " class='active'" : "") . ">" .
        "<a href='Diakok.php'>Diákok</a>" .
        "</li>" .
        "<li class='activey'" . ">" .
        "<a href='Kijelentkezes.php'>Kijelentkezés</a>" .
        "</li>" .
        "</ul></nav>";
}

function check_login($conn){
    if (isset($_COOKIE['azonosito'])) {
        $per = $_COOKIE['azonosito'];
        $query = "SELECT * FROM felhasznalo WHERE azonosito = '$per'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            return mysqli_fetch_assoc($result) ?? false;
        }
    }
    return false;
}
