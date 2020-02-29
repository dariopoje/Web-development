<?php
include('baza.class.php');
include ('funkcije.php');
session_start();
$baza = new Baza();
$baza->spojiDB();
$upit = "SELECT id_ronilacki_centar,naziv_centra,adresa,email,telefon FROM ronilacki_centar ORDER BY id_ronilacki_centar";
$rezultat = $baza->selectDB($upit);
$lista = array();

while (list($id_ronilacki_centar,$naziv_centra,$adresa,$email, $telefon) = $rezultat->fetch_array()) {
    $lista[] = array(
        "id_ronilacki_centar"=>$id_ronilacki_centar,
        "naziv_centra"=>$naziv_centra,
        "adresa"=>$adresa,
        "email"=>$email,
        "telefon"=>$telefon
        
    );
}
echo json_encode($lista);
zapisi_dnevnik("Pregled centara", "pregled centara")
?>
