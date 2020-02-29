<?php
include('baza.class.php');
include ('funkcije.php');
session_start();
$baza = new Baza();
$baza->spojiDB();
$upit = "SELECT id_lokacije,naziv_lokacije,dubina,vrijeme_prijevoza FROM lokacije WHERE odobreno ='d'";
$rezultat = $baza->selectDB($upit);
$lista = array();
while (list($id_lokacije,$naziv_lokacije,$dubina,$vrijeme_prijevoza) = $rezultat->fetch_array()) {
    $lista[] = array(
        "id_lokacije"=>$id_lokacije,
        "naziv_lokacije"=>$naziv_lokacije,
        "dubina"=>$dubina,
        "vrijeme_prijevoza"=>$vrijeme_prijevoza
        
        
    );
}
echo json_encode($lista);
zapisi_dnevnik("Pregled korisnika centra", "pregled korisnika")
?>
