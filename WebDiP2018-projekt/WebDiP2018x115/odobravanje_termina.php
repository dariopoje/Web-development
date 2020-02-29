<?php
session_start();

include("baza.class.php");
include 'funkcije.php';
$baza = new Baza();
$baza->spojiDB();

if (isset($_POST['dodjelistatus'])){

echo $_POST['termin'];
echo $_POST['stat'];

}

if (isset($_POST['dodjelistatus'])) {
    
    $upit1 = "update termini set id_status_termina='$_POST[stat]' where id_termini='$_POST[termin]'";
    $baza->updateDB($upit1);
    zapisi_dnevnik("dodjela statusa terminu", "dodjela");
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


        



        <form id="dodjelastatusa" method="post" name="dodjelastatusa" action="odobravanje_termina.php">
            <label class="labela" for="termin">Termini</label>
            <select class="textbox" name="termin">
                <option>Odaberi termin</option>
                <?php
                $upit_termin = "select termini.id_termini,lokacije.naziv_lokacije,termini.datum from termini,lokacije where termini.id_lokacije=lokacije.id_lokacije";
                $rez_termin = $baza->selectDB($upit_termin);
                while ($red1 = mysqli_fetch_array($rez_termin)) {
                    echo "<option value=" . $red1['id_termini'] . ">" . $red1['id_termini']."    ".$red1['naziv_lokacije']."    ".$red1['datum'] ."    ". "</option>";
                }
                ?>
            </select>
            <br><br>
            <label class="stat" for="stat">Status</label>
            <select class="textbox" name="stat">
                <option>Odaberi status</option>
                <?php
                $upitstatus = "select id_status_termina,status from status_termina";
                $rezultatstatus = $baza->selectDB($upitstatus);
                while ($red2 = $rezultatstatus->fetch_array()) {
                    echo "<option value=".$red2['id_status_termina'].">" . $red2['status'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <input class="gumbi" type="submit" name="dodjeli_status" value="Dodjeli status terminu">
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
