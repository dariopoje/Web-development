<?php
session_start();

include("baza.class.php");
include 'funkcije.php';
$baza = new Baza();
$baza->spojiDB();


if (isset($_POST['dodajrez'])) {
    $ter = $_POST['ter'];

    $vrijeme= pomakVremena();
    $upit_lok = "INSERT INTO `rezervacije`(`korisnik_id_korisnik`, `termini_id_termini`, `max_dubina`, `datum`, `status`) "
            . "VALUES ('$_SESSION[idKorisnik]','$ter','$_POST[max]','$vrijeme','na cekanju')";
    $baza->updateDB($upit_lok);

    zapisi_dnevnik("Dodavanje nove lokacije", "Dodavanje");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dodavanje rezervacije</title>
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
            <h1>Dodavanje rezervacije</h1>
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


        <h2>Dodaj rezervaciju</h2>
        <form method="post" id="noviCentar" name="novarezervacija" action="kreiraj_rezervaciju.php">
            <label class="labela" for="ter">Termin</label>
            <select class="textbox" name="ter">
                <option>Odaberi lokaciju</option>
                <?php
                $upittrazi = "select termini.id_termini, termini.datum,lokacije.naziv_lokacije   from termini,lokacije where termini.id_lokacije=lokacije.id_lokacije ";
                $rezultat = $baza->selectDB($upittrazi);
                while ($red2 = $rezultat->fetch_array()) {
                    $trazeniid = $red2['id_termini'];
                    
                    echo "<option value = " . $red2['id_termini'] . " >" .$br. $red2['naziv_lokacije'] . ", " . $red2['datum'] .  "</option>";
                }
                ?>
            </select>

            <label class="labela" for="max">Maksimalna dubina: </label>
            <input type ="number" class="textbox" id="max" name="max" ><br>            
            <br><br>
            <input class="button" type="submit" value="Dodaj rezervaciju" name="dodajrez" id="dodajrez"> 
        </form>
        <?php
        $baza->zatvoriDB();
        ?>
        <footer >

            <h1 ></h1>
            <address>Kontakt: <a href="mailto:dpoje@foi.hr">Dario Poje</a></address>
            <p>&copy; 2019 D.Poje</p>

        </footer>
    </body>
</html>
