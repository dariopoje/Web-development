<?php
if (empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on") {
    header("Location: https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x115/login.php");
    exit();
}

require 'baza.class.php';
//require 'sesija.class.php';
include 'funkcije.php';

if (empty($_SESSION["uloga"])) {
    $_SESSION["uloga"] = 0;
}
session_start();
if (isset($_POST['submit'])) {

    //var_dump($_POST);
    $greska = "";
    foreach ($_POST as $k => $v) {
        if (empty($v)) {
            $greska .= $k . " nije unesen!";
        }
    }
    if (empty($greska)) {
        echo 'Povezivanje na bazu!';
        $veza = new Baza();
        $veza->spojiDB();
        $korime = $_POST['korime'];
        $lozinka = $_POST['lozinka'];
        $vrijeme = time() + 3000;
        $upit = "SELECT broj_neu_prijava FROM korisnik WHERE " . "korisnicko_ime='{$korime}'";
        $rez = $veza->selectDB($upit);
         $broj= mysqli_fetch_array($rez);
         $neu_prijave=$broj;
        $salt = sha1($korime);
        //zapisano u bazi
        $kriptirano = sha1($salt . '-' . $lozinka);

        if (sha1($salt . '-' . $lozinka) == $kriptirano)
            ;


        $upit = "SELECT * FROM korisnik WHERE " . "korisnicko_ime='{$korime}' AND " .
                "lozinka='{$lozinka}'";
        $rezultat = $veza->selectDB($upit);
        $autenticiraj = false;
        while ($red = mysqli_fetch_array($rezultat)) {
            if ($red) {
                $autenticiraj = true;
                $idKorisnika = $red["id_korisnik"];
                $uloga = $red["id_uloga"];
            }
        }
        if ($autenticiraj) {
            $_SESSION["korime"] = $korime;
            $_SESSION["uloga"] = $uloga;
            $_SESSION["idKorisnik"] = $idKorisnika;
            setcookie("cookie", $korime, $uloga, $vrijeme);

            zapisi_dnevnik("Prijava korisnika u sustav", "prijava");

//zapisi_dnevnik();
            echo 'uspješna prijava';
            
            header('Location: index.php');
        } else {
            $neu_prijave++;
            echo 'neuspješna prijava';
            zapisi_dnevnik("Neuspjesna prijava korisnika u sustav", "prijava");
            /*$upit_neu = "update korisnik set broj_neu_prijava='$neu_prijave' where korisnicko_ime='$korime'";
            $baza->updateDB($upit_neu);
            if ($neu_prijave == 3) {
                $upit_blok = "update korisnik set blokiran='1' where korisnicko_ime='$korime'";
                $baza->updateDB($upit_blok);
            }*/
        }


        $veza->zatvoriDB();
    }
}
?>



<!DOCTYPE html>

<html>
    <head>
        <title>Prijava</title>
        <meta charset="UTF-8">
        <meta name="viewport" 
              content="width=device-width, initial-scale=1.0">
        <meta name="naslov" 
              content="Prijava">
        <meta name="autor" 
              content="Dario Poje">
        <meta name="kljucnaRijec" 
              content="korisničko ime,lozinka,prijava">
        <link href="main_css.css" rel="stylesheet" type="text/css">


    </head>

    <body onload="kreirajDogadaje();">
        <header>
            <h1 id="prijava">Prijava</h1>
            <hr>
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
            <hr style="margin-bottom: 20px">
        </header>


        <div id="greske">
            <?php
            if (isset($greska)) {
                echo $greska;
            }
            ?>
        </div>

        <div class="form1" style="background-color: transparent  ">

            <form novalidate id="form1" method="post" name="form1" >
                <table class="table1">
                    <tr>
                        <td style="text-align: center"><label for="korime">Korisničko ime: </label></td>
                    </tr>
                    <tr>
                        <td style="text-align: center"><input type="text" id="korime" name="korime" size="20" maxlength="20" placeholder="korisnicko ime" autofocus="autofocus" required="required"><br></td>
                    </tr>
                    <tr>
                        <td style="text-align: center"> <label for="lozinka">Lozinka: </label></td>
                    </tr>
                    <tr>
                        <td style="text-align: center"><input type="password" id="lozinka" name="lozinka" size="15" maxlength="15" placeholder="lozinka" required="required"><br></td>
                    <tr>
                        <td style="text-align: center"><input type="checkbox" name="zapamti" checked > Upamti korisničko ime<br></td>
                    </tr>
                    <tr>
                        <td style="text-align: center"><input name="submit" type="submit" value=" Prijavi se "></td>
                    </tr>
                    <tr>
                        <td style="text-align: center"><input type="button" name="zaborav" onclick="location = 'reset_lozinke.php'" value="Zaboravili ste lozinku ?">
                        </td>
                    </tr>

                </table>
            </form>
        </div>




        <footer >

            <h1 ></h1>
            <address>Kontakt: <a href="mailto:dpoje@foi.hr">Dario Poje</a></address>
            <p>&copy; 2019 D.Poje</p>

        </footer>
    </body>
</html>
