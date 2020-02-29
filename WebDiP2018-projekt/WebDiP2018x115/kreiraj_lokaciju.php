<?php
session_start();

include("baza.class.php");
include 'funkcije.php';
$baza = new Baza();
$baza->spojiDB();


if (isset($_POST['dodajlok'])) {
    $centar = $_POST['centar'];
    $vrsta = $_POST['vrsta'];
    $upitcentar = "select id_ronilacki_centar from ronilacki_centar where naziv_centra='$centar'";
    $upitvrsta = "select id_vrsta_lokacije from vrsta_lokacije where vrsta='$vrsta'";
    $rezcen = $baza->updateDB($upitcentar);
    $rezvrs = $baza->updateDB($upitvrsta);

    while ($red5 = $rezcen->fetch_array()) {
        $cen = $red5['id_ronilacki_centar'];
    }
    while ($red6 = $rezvrs->fetch_array()) {
        $vrs = $red6['id_vrsta_lokacije'];
    }

        $upit_lok = "insert into lokacije (id_ronilacki_centar,id_vrsta_lokacije,naziv_lokacije,dubina,odobreno,vrijeme_prijevoza,broj_mjesta,opis) "
                . "values($cen,$vrs,'$_POST[naziv]','$_POST[dubina]','n','$_POST[vrijeme]','$_POST[broj]','$_POST[opis]')";
        $baza->updateDB($upit_lok);

        zapisi_dnevnik("Dodavanje nove lokacije", "Dodavanje");
    
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
                    echo "<a class=razmak href=pregled_rezervacija.php>Pregled Rezervacija</a>";
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
        <form method="post" id="noviCentar" name="novalokacija" action="kreiraj_lokaciju.php">
            <label class="labela" for="centar">Centri</label>
            <select class="textbox" name="centar">
                <option>Odaberi centar</option>
                <?php
                $upitcentar = "select naziv_centra from ronilacki_centar";
                $rezultatcentar = $baza->selectDB($upitcentar);
                while ($red2 = $rezultatcentar->fetch_array()) {
                    echo "<option >" . $red2['naziv_centra'] . "</option>";
                }
                ?>
            </select>
            <label class="labela" for="vrsta">Centri</label>
            <select class="textbox" name="vrsta">
                <option>Odaberi vrstu lokacije</option>
                <?php
                $upitvrsta = "select vrsta from vrsta_lokacije";
                $rezultatvrsta = $baza->selectDB($upitvrsta);
                while ($red2 = $rezultatvrsta->fetch_array()) {
                    echo "<option >" . $red2['vrsta'] . "</option>";
                }
                ?>
            </select>
            <label class="labela" for="naziv">Naziv lokacije: </label>
            <input class="textbox" id="naziv" name="naziv" placeholder="Naziv lokacije" size="30" maxlength="50"><br>
            <label class="labela" for="dubina">Dubina:</label>
            <input class="textbox" id="dubina" name="dubina" placeholder="dubina" size="30" maxlength="70"><br>
            
            <label class="labela" for="vrijeme">Vrijeme: </label>
            <input type="time" class="textbox" id="vrijeme" name="vrijeme" placeholder="vrijeme" size="30" maxlength="50"><br>
            <label class="labela" for="broj">Broj mjesta: </label>
            <input type="number" class="textbox" id="broj" name="broj" placeholder="" size="30" maxlength="50"><br>
            <label class="labela" for="opis">Opis: </label>
            <input class="textbox" id="opis" name="opis" placeholder="" size="30" maxlength="50">
            <br><br>
            <input class="button" type="submit" value="Dodaj lokaciju" name="dodajlok" id="dodajvrstu"> 
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
