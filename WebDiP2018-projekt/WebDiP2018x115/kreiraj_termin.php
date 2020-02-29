<?php
session_start();

include("baza.class.php");
include 'funkcije.php';
$baza = new Baza();
$baza->spojiDB();


if (isset($_POST['dodajter'])) {
    $lok = $_POST['lok'];
    
    $upit = "select id_lokacije from lokacije where naziv_lokacije='$lok'";
    
    $rezcen = $baza->updateDB($upit);
    

    while ($red5 = $rezcen->fetch_array()) {
        $lok = $red5['id_lokacije'];
    }
    

        $upit_lok = "INSERT INTO `termini`(`id_status_termina`, `id_lokacije`, "
                . "`broj_slobodnih_mjesta`, `datum`) VALUES (7,'$lok','$_POST[broj]','$_POST[datum]')";
        $baza->updateDB($upit_lok);

        zapisi_dnevnik("Dodavanje novog termina", "Dodavanje");
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dodavanje lokacije</title>
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
            <h1>Dodavanje lokacije</h1>
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



        <h2>Ronilačke lokacije</h2>
        <form method="post" id="noviCentar" name="novitermin" action="kreiraj_termin.php">
            <label class="labela" for="lok">Lokacija</label>
            <select class="textbox" name="lok">
                <option>Odaberi lokaciju</option>
                <?php
                $upittrazi = "select naziv_lokacije from lokacije";
                $rezultat = $baza->selectDB($upittrazi);
                while ($red2 = $rezultat->fetch_array()) {
                    echo "<option >" . $red2['naziv_lokacije'] . "</option>";
                }
                ?>
            </select>
            
            <label class="labela" for="broj">Broj slobodnih mjesta: </label>
            <input type ="number" class="textbox" id="naziv" name="broj" ><br>
            <label class="labela" for="datum">Datum odrzavanja:</label>
            <input type ="date" class="textbox" id="dubina" name="datum" ><br>

            <br><br>
            <input class="button" type="submit" value="Dodaj termin" name="dodajter" id="dodajter"> 
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
