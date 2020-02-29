<?php
include("baza.class.php");
include 'funkcije.php';
session_start();
$baza = new Baza();
$baza->spojiDB();

//var_dump($_POST);
if (isset($_POST['odobri'])) {
    
    $ter = $_POST['ter'];
    
    $upit2 = "update rezervacije set status='odobreno' where id_rezervacije='$_POST[ter]'";
    $baza->updateDB($upit2);

    zapisi_dnevnik("Odobravanje rezervacije s id: $_POST[ter]", "odobravanje");
}if (isset($_POST['odbij'])) {
    
    $ter = $_POST['ter'];
    
    $upit2 = "update rezervacije set status='odbijeno' where id_rezervacije='$_POST[ter]'";
    $baza->updateDB($upit2);

    zapisi_dnevnik("Odbijanje rezervacije s id: $_POST[ter]", "odbijanje");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Odobravanje rezervacija</title>
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
            <h1>Pregled rezervacija</h1>
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
        <h2>Popis rezervacija: </h2>
        <?php
        $tablica = "";

        $tablica .= "<table>";
        $tablica .= "<tr>";
        $tablica .= "<th>ID rezervacije</th>";
        $tablica .= "<th>Korisnik</th>";
        $tablica .= "<th>Termin</th>";
        $tablica .= "<th>Max dubina</th>";
        $tablica .= "<th>Datum kreiranja zahtjeva</th>";
        $tablica .= "<th>Status</th>";
        $tablica .= "</tr>";
        $lista = array();

        $sql = "Select rezervacije.id_rezervacije,korisnik.korisnicko_ime,termini.id_termini, termini.datum as datum_odrzavanja,lokacije.naziv_lokacije,rezervacije.max_dubina,rezervacije.datum,rezervacije.status "
                . "from rezervacije,korisnik,lokacije,termini where rezervacije.korisnik_id_korisnik=korisnik.id_korisnik "
                . "and termini.id_lokacije=lokacije.id_lokacije and rezervacije.termini_id_termini=termini.id_termini";
        $popis = $baza->selectDB($sql);

        while ($red = $popis->fetch_assoc()) {
            $lista[] = array(
                "id_rezervacije" => $red["id_rezervacije"],
                "korisnicko_ime" => $red["korisnicko_ime"],
                "id_termini" => $red["id_termini"],
                "datum_odrzavanja" => $red["datum_odrzavanja"],
                "naziv_lokacije" => $red["naziv_lokacije"],
                "max_dubina" => $red["max_dubina"],
                "datum" => $red["datum"],
                "status" => $red["status"]
            );
        }

        for ($i = 0; $i < count($lista); $i++) {

            $tablica .= "<tr>";
            $tablica .= "<td>" . $lista[$i]["id_rezervacije"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["korisnicko_ime"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["id_termini"] . ",   " . $lista[$i]["naziv_lokacije"] . ",   " . $lista[$i]["datum_odrzavanja"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["max_dubina"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["datum"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["status"] . "</td>";

            $tablica .= "</tr>";
        }
        $tablica .= "</table>";

        echo $tablica;
        ?>
        <h2>odaberi rezervaciju</h2>
        <form method="post" id="odobravanje" name="odobravanje" action="odobravanje_rezervacija.php">
            <label class="labela" for="ter">Termin</label>
            <select class="textbox" name="ter">
                <option>Odaberi rezervaciju</option>
                <?php
                $upittrazi = "select id_rezervacije from rezervacije ";
                $rezultat = $baza->selectDB($upittrazi);
                while ($red2 = $rezultat->fetch_array()) {


                    echo "<option value = " . $red2['id_rezervacije'] . " >" . $br . $red2['id_rezervacije'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <input class="button" type="submit" value="Odobri rezervaciju" name="odobri" id="dodajrez"> 
            <input class="button" type="submit" value="Odbij rezervaciju" name="odbij" id="dodajrez"> 
        </form>
        <?php
        $baza->zatvoriDB();
        ?></a>
    <footer >

        <h1 ></h1>
        <address>Kontakt: <a href="mailto:dpoje@foi.hr">Dario Poje</a></address>
        <p>&copy; 2019 D.Poje</p>

    </footer>
</body>
</html>