<?php

require_once 'baza.class.php';

function zapisi_dnevnik($opis, $tip) {
    $veza = new Baza();
    $veza->spojiDB();

    $vrijeme = pomakVremena();
    $dnevnik_sql = "INSERT into dnevnikRada (id_korisnik,opis,tip_loga,vrijeme_pristupa) values ($_SESSION[idKorisnik],'$opis','$tip','$vrijeme')";
    $veza->updateDB($dnevnik_sql);
    $veza->zatvoriDB();
}

require_once './baza.class.php';

function dohvatiVrijeme() {
    $json = file_get_contents("http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json");
    $datoteka = json_decode($json, true);
    $brojSati = $datoteka["WebDiP"]["vrijeme"]["pomak"]["brojSati"];

    $baza = new Baza();
    $baza->spojiDB();
    $upit = "Update pomakVremena set pomakVremena='$brojSati'";
    $baza->updateDB($upit);
    $baza->zatvoriDB();
}

function pomakVremena() {
    $baza = new Baza();
    $baza->spojiDB();
    $sql = "SELECT pomakVremena from pomakVremena";
    $rez = $baza->selectDB($sql);
    $red = $rez->fetch_assoc();
    $baza->zatvoriDB();
    $brojSati = $red["pomakVremena"];
    $sad = time();
    $virtualno = $sad + $brojSati * 3600;
    return date("Y-m-d H:i:s", $virtualno);
}



?>