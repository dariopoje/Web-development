<?php
include('baza.class.php');
include ('funkcije.php');
session_start();
$baza = new Baza();
$baza->spojiDB();
$upit = "SELECT korisnik.id_korisnik,korisnik.ime,korisnik.prezime,korisnik.korisnicko_ime,korisnik.email,uloga.naziv_uloga FROM korisnik, uloga "
        . "WHERE korisnik.id_uloga=uloga.id_uloga ORDER BY id_korisnik";
$rezultat = $baza->selectDB($upit);
$lista = array();
while (list($id_korisnik,$ime,$prezime,$korisnicko_ime, $email,$uloga) = $rezultat->fetch_array()) {
    $lista[] = array(
        "id_korisnik"=>$id_korisnik,
        "ime"=>$ime,
        "prezime"=>$prezime,
        "korisnicko_ime"=>$korisnicko_ime,
        "email"=>$email,
        "uloga"=>$uloga
        
    );
}
echo json_encode($lista);
zapisi_dnevnik("Pregled korisnika centra", "pregled korisnika")
?>
