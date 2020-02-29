<?php

include("baza.class.php");
if (isset($_GET['korisnik']) && $_GET['vrijeme'] > time() - 12 * 60 * 60) {

    $korisnik = $_GET['korisnik'];

    $veza = new Baza();

    $upit_provjera = "select korisnicko_ime from korisnik";

    $veza->spojiDB();
    $rezultat = $veza->selectDB($upit_provjera);
    while (list($korime) = $rezultat->fetch_array()) {
        if ($korisnik == $korime) {
            $upit_update = "UPDATE korisnik SET id_uloga = 9 WHERE korisnicko_ime = '$korime'";
            $veza->updateDB($upit_update);
            header('Location: login.php');
        }
    }
    $rezultat->close();
    $veza->zatvoriDB();
} else {
    echo "Aktivacija neuspjesna";
}
?>
