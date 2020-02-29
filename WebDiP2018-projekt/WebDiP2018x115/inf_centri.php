<?php
include("baza.class.php");
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
        <link href="main_css.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <header>
            <h1>Pregled lokacija</h1>
        </header>
        <nav >
                <?php
                if (empty($_SESSION["uloga"])) {
                    $_SESSION["uloga"] = 0;
                }

                if ($_SESSION["uloga"] == 1) {
                    echo "<a class=razmak href=index.php>Početna stranica</a>";
                    echo "<a class=razmak href=pregled_lokacija.php>Pregled lokacija</a>";
                    echo "<a class=razmak href=Privatno/privatno.php>Korisnici</a>";
                    echo "<a class=razmak href=odobravanje_rezervacija.php>Pregled Rezervacija</a>";
                    echo "<a class=razmak href=Dokumentacija.html>Dokumentacija</a>";
                    echo "<a class=razmak href=o_autoru.html>O autoru</a>";
                    echo "<a class=razmak href=admin_page.php>Admin</a>";
                    echo "<a class=razmak href=odjava.php>Odjava</a>";
                }

                if ($_SESSION["uloga"] == 7) {
                    echo "<a class=razmak href=index.php>Početna stranica</a>";
                    echo "<a class=razmak href=pregled_lokacija.php>Pregled lokacija</a>";
                    echo "<a class=razmak href=kreiraj_lokaciju.php>Kreiraj lokaciju</a>";
                    echo "<a class=razmak href=kreiraj_termin.php>Kreiraj termin</a>";
                    echo "<a class=razmak href=odobravanje_rezervacija.php>Pregled Rezervacija</a>";
                    echo "<a class=razmak href=o_autoru.html>O autoru</a>";
                    echo "<a class=razmak href=odjava.php>Odjava</a>";
                }
                if ($_SESSION["uloga"] == 9) {
                    echo "<a class=razmak href=index.php>Početna stranica</a>";
                    echo "<a class=razmak href=pregled_lokacija.php>Pregled lokacija</a>";
                    echo "<a class=razmak href=inf_centri.php>Informacije o centrima</a>";
                    echo "<a class=razmak href=kreiraj_rezervaciju.php>Rezerviraj termin</a>";
                    echo "<a class=razmak href=moje_rezervacije.php>Moje rezervacije</a>";
                    echo "<a class=razmak href=odjava.php>Odjava</a>";
                    echo "<a class=razmak href=o_autoru.html>O autoru</a>";
                }
                if ($_SESSION["uloga"] == 10) {
                    echo "<a class=razmak href=index.php>Početna stranica</a>";
                    echo "<a class=razmak href=inf_centri.php>Informacije o centrima</a>";
                    echo "<a class=razmak href=pregled_lokacija.php>Pregled lokacija</a>";
                    echo "<a class=razmak href=login.php>Prijava</a>";
                    echo "<a class=razmak href=registracija.php>Registracija</a>";
                    echo "<a class=razmak href=o_autoru.html>O autoru</a>";
                }
                if ($_SESSION["uloga"] == 0) {
                    echo "<a class=razmak href=index.php>Početna stranica</a>";
                    echo "<a class=razmak href=inf_centri.php>Informacije o centrima</a>";
                    echo "<a class=razmak href=pregled_lokacija.php>Pregled lokacija</a>";
                    echo "<a class=razmak href=login.php>Prijava</a>";
                    echo "<a class=razmak href=registracija.php>Registracija</a>";
                    echo "<a class=razmak href=o_autoru.html>O autoru</a>";
                }
                ?>   
            </nav>
        <h2>Popis lokacija: </h2>
        <?php
        $tablica = "";

        $tablica .= "<table>";
        $tablica .= "<tr>";
        $tablica .= "<th>id_ronilacki_centar</th>";
        $tablica .= "<th>naziv_centra</th>";
        $tablica .= "<th>adresa</th>";
        $tablica .= "<th>email</th>";
        $tablica .= "<th>telefon</th>";

        $tablica .= "</tr>";
        $lista = array();

        $upit = "SELECT id_ronilacki_centar,naziv_centra,adresa,email,telefon FROM ronilacki_centar ORDER BY id_ronilacki_centar";
        $rezultat = $baza->selectDB($upit);


        while ($red = $rezultat->fetch_assoc()) {
            $lista[] = array(
                "id_ronilacki_centar" => $red["id_ronilacki_centar"],
                "naziv_centra" => $red["naziv_centra"],
                "adresa" => $red["adresa"],
                "email" => $red["email"],
                "telefon" => $red["telefon"],
            );
        }


        for ($i = 0; $i < count($lista); $i++) {

            $tablica .= "<tr>";
            $tablica .= "<td>" . $lista[$i]["id_ronilacki_centar"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["naziv_centra"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["adresa"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["email"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["telefon"] . "</td>";
            $tablica .= "</tr>";
        }
        $tablica .= "</table>";
        $tablica .= "</form>";
        echo $tablica;

        $baza->zatvoriDB();
        ?>