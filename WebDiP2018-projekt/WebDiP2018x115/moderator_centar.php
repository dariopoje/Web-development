<?php
session_start();

include("baza.class.php");
include 'funkcije.php';
$baza = new Baza();
$baza->spojiDB();
if (isset($_POST['moder'])) {
    $upit2 = "update korisnik set id_uloga=7 where korisnicko_ime='$_POST[svi]'";
    $baza->updateDB($upit2);
    zapisi_dnevnik("Admin je promaknuo korisnika $_POST[svi] u moderatora", "moderator");
}


if (isset($_GET['dodjeli'])) {
    $moderator = $_GET['moderatori'];
    $centar = $_GET['centar'];
    $upitIme = "select id_korisnik from korisnik where korisnicko_ime='$moderator'";
    $upitcentar = "select id_ronilacki_centar from ronilacki_centar where naziv_centra='$centar'";
    $rezIme = $baza->selectDB($upitIme);
    $rezCentar = $baza->selectDB($upitcentar);
    while ($red = $rezIme->fetch_array()) {
        $ime = $red['id_korisnik'];
    }
    while ($red3 = $rezCentar->fetch_array()) {
        $centri = $red3['id_ronilacki_centar'];
    }
    $upit_unos = "insert into moderator (id_korisnik,id_ronilacki_centar) values($ime,$centri)";
    $baza->updateDB($upit_unos);
    zapisi_dnevnik("dodjela moderatora centru", "dodjela");
}




if (isset($_POST['dodajcentar'])) {
    //var_dump($_POST);
    $naz = $_POST['naziv'];
    $adr = $_POST['adresa'];
    $upis_mail = $_POST['email'];
    $tel = $_POST['telefon'];
    $upit_centar = "INSERT INTO `ronilacki_centar`(`naziv_centra`, `adresa`, `email`, `telefon`) VALUES ('$naz','$adr','$upis_mail','$tel')";
    $baza->updateDB($upit_centar);
    zapisi_dnevnik("Dodavanje novog centra", "Dodavanje");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Moderatori i centri</title>
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
            <h1>Moderatori i ustanove</h1>
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


        <h2>Moderatori</h2>
        <form id="moder" method="post" name="moder" action="moderator_centar.php">
            <label class="labela" for="svi">Svi korisnici</label>
            <select class="textbox" name="svi">
                <option>Odaberi korisnika</option>
                <?php
                $upit = "select korisnicko_ime from korisnik where id_uloga=9";
                $rezultat = $baza->selectDB($upit);
                while ($red = mysqli_fetch_array($rezultat)) {
                    echo "<option value=" . $red['korisnicko_ime'] . ">" . $red['korisnicko_ime'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <input class="gumbi" type="submit" name="moder" value="Promakni korisnika u moderatora">
        </form>



        <br>



        <form id="dodjelamoderatora" method="get" name="dodjelamoderatora" action="moderator_centar.php">
            <label class="labela" for="moderatori">Moderatori</label>
            <select class="textbox" name="moderatori">
                <option>Odaberi moderatora</option>
                <?php
                $upit_Moder = "select korisnicko_ime from korisnik where id_uloga=7";
                $rez_moder = $baza->selectDB($upit_Moder);
                while ($red1 = mysqli_fetch_array($rez_moder)) {
                    echo "<option value=" . $red1['korisnicko_ime'] . ">" . $red1['korisnicko_ime'] . "</option>";
                }
                ?>
            </select>
            <br><br>
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
            <br><br>
            <input class="gumbi" type="submit" name="dodjeli" value="Dodjeli moderatora centru">
        </form>


        <h2>Ronilački centri</h2>
        <form method="post" id="noviCentar" name="noviCentar" action="moderator_centar.php">
            <label class="labela" for="naz">Naziv Centra: </label>
            <input class="textbox" id="nazivCentra" name="naziv" placeholder="Naziv centra" size="30" maxlength="50">
            <label class="labela" for="adr">Adresa centra:</label>
            <input class="textbox" id="adresaCentra" name="adresa" placeholder="Adresa centra" size="30" maxlength="70">
            <label class="labela" for="email">Email adresa: </label>
            <input class="textbox" type="email" id="email" name="email" size="35" maxlength="35" placeholder="imecentra@posluzitelj.xxx" ><br><br>
            <label class="labela" for="telefon">Broj telefona: </label>
            <input class="textbox" type="text" id="telefon" name="telefon" size="20" maxlength="50" placeholder="Broj telefona" ><br><br>

            <br><br>
            <input class="button" type="submit" value="Dodaj centar" name="dodajcentar" id="dodajCentar"> 
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
