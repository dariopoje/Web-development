<?php
$q=$_GET['q'];
$server = "localhost";
$korisnik = "WebDiP2018x115";
$lozinka = "admin_rvSm";
$baza = "WebDiP2018x115";


$con= mysqli_connect($server, $korisnik, $lozinka, $baza);
mysqli_select_db($con, $baza);
$sql="select * from `korisnik` where `korisnicko_ime`='".$q."'";
$rezultat=mysqli_query($con,$sql);
while($red= mysqli_fetch_array($rezultat)){
    if($red["korisnicko_ime"]==$q){
        echo "Greška";
    }
}
mysqli_close($con);
?>