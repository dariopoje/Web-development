<?php
session_start();
if (isset($_POST["zaboravljena"])) {
    include("baza.class.php");
    $veza = new Baza();
    $upit = "select lozinka from korisnik where korisnicko_ime='$_POST[korime]'and email='$_POST[email]'";
    $veza->spojiDB();
    $rezultat = $veza->selectDB($upit);
    $novaLozinka="";
    while (list($lozinka) = $rezultat->fetch_array()) {
        $trazena_lozinka = $lozinka;
    }

    function randomLozinka() {
        $novaLozinka="";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!#$?";
        for ($i = 0; $i < 10; $i++) {
            $novaLozinka .= $chars[mt_rand(0, strlen($chars)-1)];
        }

        return $novaLozinka;
    }

    $novaLozinka = randomLozinka();
    $sol=sha1(time());
    $kriptiranaLozinka=sha1($sol."-".$novaLozinka);
    $mail_to = $_POST["email"];
    $mail_from = "FROM: appAdmin";
    $mail_subject = "Zaboravljena lozinka.";
    $mail_body = "Vaši podaci za prijavu su: Korisničko ime: $_POST[korime],Lozinka:$novaLozinka";
    mail($mail_to, $mail_subject, $mail_body, $mail_from);
    $upit2="Update korisnik set lozinka='$novaLozinka',lozinka_kriptirano='$kriptiranaLozinka' where korisnicko_ime='$_POST[korime]'";
    $veza->updateDB($upit2);
    $veza->zatvoriDB();
    header('Location: login.php');
}
?>

<html>
    <head>
        <title>Zaboravljena lozinka</title>
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
            <h1>Zaboravljena lozinka</h1>
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

        
        <section>
            <h1>Upišite korisničko ime i email kako bi resetirali lozinku</h1><br>
            <form method="post" id="prijava" action="reset_lozinke.php">
                <label class="labela" for="korime">Korisničko ime: </label>
                <input class="textbox" id="korime" type="text" name="korime"><br>
                <label class="labela" for="email">Email: </label>
                <input class="textbox" id="email" type="text" name="email"><br><br>
                <input class="gumbi" id="zaborav" name="zaboravljena" type="submit" value="Pošalji">
            </form>
        </section>
    </body>
</html>