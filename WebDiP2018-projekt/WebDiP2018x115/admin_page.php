<?php
include("baza.class.php");
include 'funkcije.php';
session_start();
$baza = new Baza();
$baza->spojiDB();
if (isset($_POST['odblokiraj'])) {
    $upit1 = "update korisnik set blokiran=0 where korisnicko_ime='$_POST[blokirani]'";
    $baza->updateDB($upit1);
    zapisi_dnevnik("Admin je odblokirao korisnika $_POST[blokirani]", "odblokiranje");
    
}
if (isset($_POST['blokiraj'])) {
    $upit2 = "update korisnik set blokiran=1 where korisnicko_ime='$_POST[neblokirani]'";
    $baza->updateDB($upit2);
    zapisi_dnevnik("Admin je blokirao korisnika $_POST[neblokirani]", "blokiranje");

}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Stranica administratora</title>
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
            <h1>Adminove stranice</h1>
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
                    echo "<a class=razmak href=odobravanje_rezervacija.php>Rezerviraj termin</a>";
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
        <h2>Otključavanje računa: </h2>
        <form id="odblokiraj" method="post" name="odblokiraj" action="admin_page.php">
            <label class="labela" for="blokirani">Blokirani korisnici</label>
            <select class="textbox" name="blokirani">
                <option>Odaberi korisnika</option>
                <?php
                $upit_odblok = "select korisnicko_ime from korisnik where blokiran=1";
                $rezultat = $baza->selectDB($upit_odblok);
                while ($red = mysqli_fetch_array($rezultat)) {
                    echo "<option value=" . $red['korisnicko_ime'] . ">" . $red['korisnicko_ime'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <input class="gumbi" type="submit" name="odblokiraj" value="Odblokiraj korisnika">
        </form>
        <br>
        <h2>Blokiranje računa: </h2>
        <form id="blok" method="post" name="blok" action="admin_page.php">
            <label class="labela" for="normalni">Ne blokirani korisnici</label>
            <select class="textbox" name="neblokirani">
                <option>Odaberi korisnika</option>
                <?php
                $upit_blok = "select korisnicko_ime from korisnik where blokiran=0";
                $rezultat2 = $baza->selectDB($upit_blok);
                while ($red2 = mysqli_fetch_array($rezultat2)) {
                    echo "<option value=" . $red2['korisnicko_ime'] . ">" . $red2['korisnicko_ime'] . "</option>";
                }
                ?> 
            </select>
            <br><br>
            <input class="gumbi" type="submit" name="blokiraj" value="Blokiraj korisnika">
        </form>
        <div style="padding-top: 20px; ">
            <input type="button" onclick="location = 'moderator_centar.php'" value="Moderatori i centri">
            <input type="button" onclick="location = 'kreiraj_vrstu_lokacije.php'" value="Vrste lokacija">
            <input type="button" onclick="location = 'odobri_lokaciju.php'" value="Odobri lokaciju">
            <input type="button" onclick="location = 'Admin_pregledDnevnika.php'" value="Dnevnik">
            <input type="button" onclick="location = 'ispis_centara.php'" value="ispis centara">
            <input type="button" onclick="location = 'ispis_korisnika.php'" value="ispis korisnika">
            <input type="button" onclick="location = 'ispis_lokacija.php'" value="ispis lokacija">
            <input type="button" onclick="location = 'vrijeme_pomak.php'" value="pomak vremena">
            
            
        </div>
        
        <h2>Statistika Lokacija: </h2>
        
        <?php
        $tablica = "";
        $tablica .= "<form method=post>";
        
        $tablica .= "<table>";
        $tablica .= "<tr>";
        $tablica .= "<th>ID</th>";
        $tablica .= "<th>Naziv</th>";
        $tablica .= "<th>Vrsta lokacije</th>";
        $tablica .= "<th>Naziv centra</th>";
        $tablica .= "<th>Dubina</th>";
        $tablica .= "<th>Vrijeme prijevoza</th>";
        $tablica .= "<th>Broj mjesta </th>";
        $tablica .= "<th>Broj rezervacija </th>";
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
            
            $find=$red["id_rezervacije"];
            $sql2 = "Select rezervacije.id_rezervacije from rezervacije,termini,lokacije  where rezervacije.termini_id_termini=termini.id_termini and termini.id_lokacije=".$find."";
            $popis2 = $baza->selectDB($sql2);
            $broj_rez[]=array(
                "id_rezervacije" => $red["id_rezervacije"],
            );
            $tablica .= "<tr>";
            $tablica .= "<td>" . $lista[$i]["id_lokacije"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["naziv_lokacije"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["vrsta"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["naziv_centra"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["dubina"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["vrijeme_prijevoza"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["broj_mjesta"] . "</td>";
            $tablica .= "<td>" . count($broj_rez) . "</td>";
           $tablica .= "</tr>";
        }
        $tablica .= "</table>";
        $tablica .= "</form>";
        echo $tablica;

        $baza->zatvoriDB();
        ?>
        
<?php $baza->zatvoriDB(); ?>
        <footer >

            <h1 ></h1>
            <address>Kontakt: <a href="mailto:dpoje@foi.hr">Dario Poje</a></address>
            <p>&copy; 2019 D.Poje</p>

        </footer>
    </body>
</html>
