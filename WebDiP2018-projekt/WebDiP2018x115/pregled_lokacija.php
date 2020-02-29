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
        $tablica .= "<form method=post action=pregled_lokacija.php>";
        $tablica .= "<input type=textbox name=naziv placeholder=\"Unesite naziv\"><br>";


        $tablica .= "<input  type=submit name=filtrirajnaziv value=\"Filtriraj naziv\"><br>";
        $tablica .= "<input  type=submit name=filtrirajodobrene value=\"Filtriraj odobrene\"><br>";
        $tablica .= "<table>";
        $tablica .= "<tr>";
        $tablica .= "<th>ID</th>";
        $tablica .= "<th>Naziv</th>";
        $tablica .= "<th>Vrsta lokacije</th>";
        $tablica .= "<th>Naziv centra</th>";
        $tablica .= "<th>Dubina</th>";
        $tablica .= "<th>Vrijeme prijevoza</th>";
        $tablica .= "<th>Broj mjesta</th>";
        $tablica .= "<th>Pogledaj slike</th>";
        $tablica .= "</tr>";
        $lista = array();
        if (isset($_POST["filtrirajnaziv"])) {
            $sql = "Select id_lokacije,naziv_lokacije,dubina,vrijeme_prijevoza,broj_mjesta from lokacije where "
                    . "naziv_lokacije like '%" . $_POST['naziv'] . "%' order by "
                    . "naziv_lokacije asc";
            $popis = $baza->selectDB($sql);

            while ($red = $popis->fetch_assoc()) {
                $lista[] = array(
                    "id_lokacije" => $red["id_lokacije"],
                    "naziv_lokacije" => $red["naziv_lokacije"],
                    "dubina" => $red["dubina"],
                    "vrijeme_prijevoza" => $red["vrijeme_prijevoza"],
                    "broj_mjesta" => $red["broj_mjesta"]
                );
            }
        } elseif (isset($_POST["filtrirajodobrene"])) {
            $sql = "Select lokacije.id_lokacije,ronilacki_centar.naziv_centra,lokacije.naziv_lokacije,lokacije.dubina,lokacije.vrijeme_prijevoza,lokacije.broj_mjesta,vrsta_lokacije.vrsta from "
                    . "lokacije,ronilacki_centar,vrste_lokacije"
                    . " where lokacije.id_ronilacki_centar=ronilacki_centar.id_ronilacki_centar and lokacije.id_vrsta_lokacije=vrsta_lokacije.id_vrsta_lokacije ";
            $popis = $baza->selectDB($sql);

            while ($red = $popis->fetch_assoc()) {
                $lista[] = array(
                    "id_lokacije" => $red["id_lokacije"],
                    "naziv_lokacije" => $red["naziv_lokacije"],
                    "vrsta" => $red["vrsta"],
                    "naziv_centra" => $red["naziv_centra"],
                    "dubina" => $red["dubina"],
                    "vrijeme_prijevoza" => $red["vrijeme_prijevoza"],
                    "broj_mjesta" => $red["broj_mjesta"]
                );
            }
        } else {
            $sql = "Select lokacije.id_lokacije,ronilacki_centar.naziv_centra,lokacije.naziv_lokacije,lokacije.dubina,lokacije.vrijeme_prijevoza,lokacije.broj_mjesta,vrsta_lokacije.vrsta from "
                    . "lokacije,ronilacki_centar,vrsta_lokacije"
                    . " where lokacije.id_ronilacki_centar=ronilacki_centar.id_ronilacki_centar and lokacije.id_vrsta_lokacije=vrsta_lokacije.id_vrsta_lokacije ";
            $popis = $baza->selectDB($sql);

            while ($red = $popis->fetch_assoc()) {
                $lista[] = array(
                    "id_lokacije" => $red["id_lokacije"],
                    "naziv_lokacije" => $red["naziv_lokacije"],
                    "vrsta" => $red["vrsta"],
                    "naziv_centra" => $red["naziv_centra"],
                    "dubina" => $red["dubina"],
                    "vrijeme_prijevoza" => $red["vrijeme_prijevoza"],
                    "broj_mjesta" => $red["broj_mjesta"]
                );
            }
        }

        for ($i = 0; $i < count($lista); $i++) {
            
            $tablica .= "<tr>";
            $tablica .= "<td>" . $lista[$i]["id_lokacije"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["naziv_lokacije"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["vrsta"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["naziv_centra"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["dubina"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["vrijeme_prijevoza"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["broj_mjesta"] . "</td>";
            $tablica .= "<td>" ."<a href="."https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x115/lokacija_slike.php?naziv=".$lista[$i]["naziv_lokacije"]." class="."button".">Slike</a> "."</td>";
            $tablica .= "</tr>";
        }
        $tablica .= "</table>";
        $tablica .= "</form>";
        echo $tablica;

        $baza->zatvoriDB();
        ?>