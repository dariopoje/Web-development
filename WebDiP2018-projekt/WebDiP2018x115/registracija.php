<?php
if (empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on") {
    header("Location: https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x115/registracija.php");
    exit();
}

require 'baza.class.php';
//require 'sesija.class.php';
include 'funkcije.php';
session_start();
if (empty($_SESSION["uloga"])) {
    $_SESSION["uloga"] = 0;
}

$a = md5(time());
$captcha_tekst = substr($a, 0, 5);

if (isset($_POST['reg'])) {

    //var_dump($_POST);
    $greska = "";
    if ($_POST["odgovor"] != $_POST["rjesenje"]) {

        $greska .= "Krivo unesena captcha!";
    }
    if ($_POST ["lozinka"] != $_POST ["pon_lozinka"]) {
        $greska .= "Lozinke moraju biti iste";
    }
    if (preg_match("/^[A-Za-z0-9$!?#]{8,}$/", $_POST["lozinka"]) == 0) {
        $greska .= "Lozinka mora imat barem 8 znakova. <br>";
    }
    foreach ($_POST as $k => $v) {
        if (empty($v)) {
            $greska .= $k . " nije unesen!";
        }
    }
    if (empty($greska)) {
        echo 'Povezivanje na bazu!';
        $veza = new Baza();
        $veza->spojiDB();

        $sol = sha1(time());
        $kriptiranaLozinka = sha1($sol . "-" . $_POST["lozinka"]);
        $upit_unos = "insert into korisnik (id_uloga,ime,prezime,korisnicko_ime,email,lozinka,lozinka_kriptirano) values (10,'$_POST[ime]','$_POST[prezime]','$_POST[korisnicko_ime]','$_POST[email]','$_POST[lozinka]','$kriptiranaLozinka')";

        $veza->updateDB($upit_unos);

        $korisnik = $_POST["korisnicko_ime"];
        $mail_to = $_POST["email"];
        $mail_from = "FROM: appAdmin";
        $mail_subject = "Link za aktivaciju racuna.";
        $time = time();
        $mail_body = "$_POST[korisnicko_ime] molimo Vas da kliknete na sljedeci link kako bi aktivirali svoj racun: https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x115/aktivacija_korisnika.php?korisnik=$korisnik&vrijeme=$time";
        mail($mail_to, $mail_subject, $mail_body, $mail_from);
        header('Location: login.php');


        $rs->close();
        $bp->zatvoriDB();
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Registracija</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js_registracija.js"></script>

    </head>
    <body>
        <header>
            <h1>Registracija</h1>
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

        <br>
        <div class="obrazacBox">
            <form class="registracija_frm" id="registracija_frm" method="post" name="formaZaRegistraciju" action="registracija.php">               
                <label class="labela" for="ime">Ime: </label>
                <input class="textbox" type="text" id="ime" name="ime" size="20" maxlength="30" placeholder="Ime"><br><br>
                <label class="labela" for="prez">Prezime: </label>
                <input class="textbox" type="text" id="prezime" name="prezime" size="20" maxlength="50" placeholder="Prezime" ><br><br>
                <label class="labela" for="korime">Korisničko ime: </label>
                <input class="textbox" type="text" id="korisnicko_ime" name="korisnicko_ime" size="20" maxlength="20"  placeholder="korisničko ime" ><br><br>
                <label class="labela" for="email">Email adresa: </label>
                <input class="textbox" type="email" id="email" name="email" size="35" maxlength="35" placeholder="ime.prezime@posluzitelj.xxx" ><br><br>
                <label class="labela" for="lozinka1">Lozinka: </label>
                <input class="textbox" type="password" id="lozinka" name="lozinka" size="20" maxlength="20"  placeholder="lozinka" ><br><br>
                <label class="labela" for="lozinka2">Ponovi lozinku: </label>
                <input class="textbox" type="password" id="pon_lozinka" name="pon_lozinka" size="15" maxlength="15"  placeholder="lozinka" ><br>    <br>                 
                <div class="captcha" style="background-image: url('slike/captcha.png'); background-size: contain; margin-left: 46%; margin-right: 46%;"> 
                    <?php echo $captcha_tekst; ?>
                </div>

                <label class="labela" for="captcha">Captcha</label>
                <input class="textbox" type="text" id="kapca" name="odgovor" size="10"  maxlength="10"><br><br>
                <input type="hidden" name="rjesenje" value="<?php echo $captcha_tekst ?>">
                <input class="gumbi" id="regis" name="reg"  type="submit"  value=" Registriraj se ">

            </form>

        </div>
        <?php
        if (isset($greska)) {
            echo $greska;
        }
        ?>
        <br>
        <footer >

            <h1 ></h1>
            <address>Kontakt: <a href="mailto:dpoje@foi.hr">Dario Poje</a></address>
            <p>&copy; 2019 D.Poje</p>

        </footer>
    </body>
</html>



