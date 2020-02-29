<?php
include('baza.class.php');
$baza = new Baza();
$baza->spojiDB();
$sql = "Select korisnik.korisnicko_ime,dnevnikRada.opis,dnevnikRada.vrijeme_pristupa from korisnik, dnevnikRada where "
                    . "dnevnikRada.id_korisnik=korisnik.id_korisnik order by "
                    . "vrijeme_pristupa asc";
$rez = $baza->selectDB($sql);
$lista = array();
while (list($korisnicko_ime,$opis,$vrijeme_pristupa) = $rez->fetch_array()) {
    $lista[] = array(
        "korisnicko_ime"=>$korisnicko_ime,
        "opis"=>$opis,
        "vrijeme_pristupa"=>$vrijeme_pristupa
    );
}
echo json_encode($lista);
?>






