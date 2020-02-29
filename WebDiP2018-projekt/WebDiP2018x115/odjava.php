<?php
include("baza.class.php");
include 'funkcije.php';
$veza = new Baza();
$veza->spojiDB();
session_start();

zapisi_dnevnik("Odjava", "Odjava");

session_destroy();
$_SESSION = array();
header("Location:index.php");
?>
