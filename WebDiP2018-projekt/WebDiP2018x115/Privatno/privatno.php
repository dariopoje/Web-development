<?php
if (empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on") {
    header("Location: https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x115/login.php");
    exit();
}

include("../baza.class.php");
session_start();
$baza = new Baza();
$baza->spojiDB();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pregled lokacija</title>
        <meta charset="UTF-8">
        <meta name="viewport" 
              content="width=device-width, initial-scale=1.0">
        <meta name="naslov" 
              content="Pocetna">
        <meta name="autor" 
              content="Dario Poje">
        <meta name="kljucnaRijec" 
              content="korisničko ime,lozinka,prijava">
        <link href="../main_css.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <header>
            <h1>Pregled korisnika</h1>
        </header>
        <nav >
                <?php
                if (empty($_SESSION["uloga"])) {
                    $_SESSION["uloga"] = 0;
                }

                if ($_SESSION["uloga"] == 1) {
                    echo "<a class=razmak href=../index.php>Početna stranica</a>";
                    echo "<a class=razmak href=../pregled_lokacija.php>Pregled lokacija</a>";
                    echo "<a class=razmak href=privatno.php>Korisnici</a>";
                    echo "<a class=razmak href=../odobravanje_rezervacija.php>Pregled Rezervacija</a>";
                    echo "<a class=razmak href=../Dokumentacija.html>Dokumentacija</a>";
                    echo "<a class=razmak href=../o_autoru.html>O autoru</a>";
                    echo "<a class=razmak href=../admin_page.php>Admin</a>";
                    echo "<a class=razmak href=../odjava.php>Odjava</a>";
                }

                if ($_SESSION["uloga"] == 7) {
                    echo "<a class=razmak href=../index.php>Početna stranica</a>";
                    echo "<a class=razmak href=../pregled_lokacija.php>Pregled lokacija</a>";
                    echo "<a class=razmak href=../kreiraj_lokaciju.php>Kreiraj lokaciju</a>";
                    echo "<a class=razmak href=../kreiraj_termin.php>Kreiraj termin</a>";
                    echo "<a class=razmak href=../odobravanje_rezervacija.php>Pregled Rezervacija</a>";
                    echo "<a class=razmak href=../o_autoru.html>O autoru</a>";
                    echo "<a class=razmak href=../odjava.php>Odjava</a>";
                }
                if ($_SESSION["uloga"] == 9) {
                    echo "<a class=razmak href=../index.php>Početna stranica</a>";
                    echo "<a class=razmak href=../pregled_lokacija.php>Pregled lokacija</a>";
                    echo "<a class=razmak href=../inf_centri.php>Informacije o centrima</a>";
                    echo "<a class=razmak href=../kreiraj_rezervaciju.php>Rezerviraj termin</a>";
                    echo "<a class=razmak href=../moje_rezervacije.php>Moje rezervacije</a>";
                    echo "<a class=razmak href=../odjava.php>Odjava</a>";
                    echo "<a class=razmak href=../o_autoru.html>O autoru</a>";
                }
                if ($_SESSION["uloga"] == 10) {
                    echo "<a class=razmak href=../index.php>Početna stranica</a>";
                    echo "<a class=razmak href=../inf_centri.php>Informacije o centrima</a>";
                    echo "<a class=razmak href=../pregled_lokacija.php>Pregled lokacija</a>";
                    echo "<a class=razmak href=../login.php>Prijava</a>";
                    echo "<a class=razmak href=../registracija.php>Registracija</a>";
                    echo "<a class=razmak href=../o_autoru.html>O autoru</a>";
                }
                if ($_SESSION["uloga"] == 0) {
                    echo "<a class=razmak href=../index.php>Početna stranica</a>";
                    echo "<a class=razmak href=../inf_centri.php>Informacije o centrima</a>";
                    echo "<a class=razmak href=../pregled_lokacija.php>Pregled lokacija</a>";
                    echo "<a class=razmak href=../login.php>Prijava</a>";
                    echo "<a class=razmak href=../registracija.php>Registracija</a>";
                    echo "<a class=razmak href=../o_autoru.html>O autoru</a>";
                }
                ?>   
            </nav>
        <h2>Popis lokacija: </h2>
        <?php
        $tablica = "";
        $tablica .= "<table>";
        $tablica .= "<tr>";
        $tablica .= "<th>id korisnika</th>";
        $tablica .= "<th>naziv uloge</th>";
        $tablica .= "<th>ime</th>";
        $tablica .= "<th>prezime</th>";
        $tablica .= "<th>korisnicko_ime</th>";
        $tablica .= "<th>email</th>";
        $tablica .= "<th>lozinka</th>";
        $tablica .= "<th>lozinka_kriptirano</th>";
        $tablica .= "<th>blokiran</th>";
        $tablica .= "</tr>";
        $lista = array();

        /*$sql = "SELECT `korisnik.id_korisnik`, `uloga.naziv_uloga`, `korisnik.ime`, `korisnik.prezime`, `korisnik.korisnicko_ime`, `korisnik.email`, `korisnik.lozinka`, `"
                . "korisnik.lozinka_kriptirano`, `korisnik.blokiran` "
                . "FROM `korisnik`,`uloga` WHERE `uloga.id_uloga`=`korisnik.id_uloga`";*/
        $sql2="SELECT `id_korisnik`, `id_uloga`, `ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka`, `lozinka_kriptirano`, `blokiran` FROM `korisnik` WHERE 1";
        $popis = $baza->selectDB($sql2);

        while ($red = $popis->fetch_assoc()) {
            $lista[] = array(
                "id_korisnik" => $red["id_korisnik"],
                "id_uloga" => $red["id_uloga"],
                "ime" => $red["ime"],
                "prezime" => $red["prezime"],
                "korisnicko_ime" => $red["korisnicko_ime"],
                "email" => $red["email"],
                "lozinka" => $red["lozinka"],
                "lozinka_kriptirano" => $red["lozinka_kriptirano"],
                "blokiran" => $red["blokiran"],
            );
        }


        for ($i = 0; $i < count($lista); $i++) {
            $tablica .= "<tr>";
            $tablica .= "<td>" . $lista[$i]["id_korisnik"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["id_uloga"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["ime"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["prezime"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["korisnicko_ime"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["email"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["lozinka"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["lozinka_kriptirano"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["blokiran"] . "</td>";
            $tablica .= "</tr>";
        }
        $tablica .= "</table>";

        echo $tablica;

        $baza->zatvoriDB();
        ?>