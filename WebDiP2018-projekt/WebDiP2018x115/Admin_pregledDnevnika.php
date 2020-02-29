<?php
include("baza.class.php");
session_start();
$baza = new Baza();
$baza->spojiDB();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pregled dnevnika</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    </script>
    <script src="dnevnik.js" type="text/javascript">
    </script>
</head>
<body>
    <header>
        <h1>Pregled dnevnika</h1>
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

        <h2>Dnevnik rada: </h2>
        <?php
        $tablica = "";
        $tablica .= "<form method=post action=Admin_pregledDnevnika.php>";
        $tablica .= "<input type=textbox name=korisnik placeholder=\"Unesite korisnika\"><br>";
        $tablica .= "<input  type=date name=datum placeholder=\"Unesite datum\"><br>";
        $tablica .= "<input  type=textbox name=aktivnost placeholder=\"Unesite aktivnost\"><br>";
        $tablica .= "<input  type=submit name=filtrirajKorisnik value=\"Filtriraj korisnika\"><br>";
        $tablica .= "<input  type=submit name=filtrirajDatum value=\"Filtriraj datum\"><br>";
        $tablica .= "<input type=submit name=filtrirajAktivnost value=\"Filtriraj aktivnost\"><br>";
        $tablica .= "<table>";
        $tablica .= "<tr>";
        $tablica .= "<th>Korisnik</th>";
        $tablica .= "<th>Vrijeme pristupa</th>";
        $tablica .= "<th>Tip loga</th>";

        $tablica .= "</tr>";
/*
        if (isset($_POST["filtrirajKorisnik"])) {
            $sql = "Select korisnik.korisnicko_ime,dnevnikRada.tip_loga,dnevnikRada.vrijeme_pristupa from korisnik, dnevnikRada where "
                    . "dnevnikRada.id_korisnik=korisnik.id_korisnik and korisnik.korisnicko_ime like '%" . $_POST["korisnik"] . "%' order by "
                    . "vrijeme_pristupa asc";
            $dnevnik = $baza->selectDB($sql);
            $lista = array();
            while ($red = $dnevnik->fetch_assoc()) {
                $lista[] = array(
                    "korisnicko_ime" => $red["korisnicko_ime"],
                    "tip_loga" => $red["tip_loga"],
                    "vrijeme_pristupa" => $red["vrijeme_pristupa"]
                );
            }
        } elseif (isset($_POST["filtrirajAktivnost"])) {
            $sql = "Select korisnik.korisnicko_ime,dnevnikRada.tip_loga,dnevnikRada.vrijeme_pristupa from korisnik, dnevnikRada where "
                    . "dnevnikRada.id_korisnik=korisnik.id_korisnik and dnevnikRada.tip_loga like '%" . $_POST["aktivnost"] . "%' order by "
                    . "vrijeme_pristupa asc";
            $dnevnik = $baza->selectDB($sql);
            $lista = array();
            while ($red = $dnevnik->fetch_assoc()) {
                $lista[] = array(
                    "korisnicko_ime" => $red["korisnicko_ime"],
                    "tip_loga" => $red["tip_loga"],
                    "vrijeme_pristupa" => $red["vrijeme_pristupa"]
                );
            }
        } elseif (isset($_POST["filtDat"])) {
            $sql = "Select korisnik.korisnicko_ime,dnevnikRada.tip_loga,dnevnikRada.vrijeme_pristupa from korisnik, dnevnikRada where "
                    . "dnevnikRada.id_korisnik=korisnik.id_korisnik and dnevnikRada.vrijeme_pristupa like '%" . $_POST["datum"] . "%' order by "
                    . "vrijeme_pristupa asc";

            $dnevnik = $baza->selectDB($sql);
            $lista = array();
            while ($red = $dnevnik->fetch_assoc()) {
                $lista[] = array(
                    "tip_loga" => $red["tip_loga"],
                    "vrijeme_pristupa" => $red["vrijeme_pristupa"],
                    "korisnicko_ime" => $red["korisnicko_ime"]
                );
            }
        } else {
            $sql = "Select korisnik.korisnicko_ime,dnevnikRada.tip_loga,dnevnikRada.vrijeme_pristupa from korisnik, dnevnikRada where "
                    . "dnevnikRada.id_korisnik=korisnik.id_korisnik order by "
                    . "vrijeme_pristupa asc";

            $dnevnik = $baza->selectDB($sql);
            $lista = array();
            while ($red = $dnevnik->fetch_assoc()) {
                $lista[] = array(
                    "korisnicko_ime" => $red["korisnicko_ime"],
                    "tip_loga" => $red["tip_loga"],
                    "vrijeme_pristupa" => $red["vrijeme_pristupa"]
                );
            }
        }
        for ($i = 0; $i < count($lista); $i++) {
            $tablica .= "<tr>";
            $tablica .= "<td>" . $lista[$i]["korisnicko_ime"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["vrijeme_pristupa"] . "</td>";
            $tablica .= "<td>" . $lista[$i]["tip_loga"] . "</td>";
            $tablica .= "</tr>";
        }*/
        $tablica .= "</table>";
        /*$tablica .= "</form>";
        echo $tablica;
*/
        $baza->zatvoriDB();
        ?>

        <div id="dnevnik_lista">
        </div>
        <div style="text-align: center">
            <input type="button" id="prvaStranica" value="Prva stranica">
            <input type="button" id="prethodnaStranica" value="Prethodna stranica">
            <input type="button" id="sljedecaStranica" value="Sljedeća stranica">
            <input type="button" id="zadnjaStranica" value="Zadnja stranica">
        </div>


        <footer>
            <address>Kontakt: <a href="mailto:dpoje@foi.hr">Dario Poje</a></address>
            <p>&copy; 2019 D.Poje</p>
        </footer>
</body>
</html>



