addEventListener("load", function (event) {
    kreirajDogadaje();
});
function kreirajDogadaje() {
    

    var lozinka = document.getElementById("lozinka");
    lozinka.addEventListener("keyup", function (event) {
        var reg = new RegExp(/^[A-Za-z0-9$!?#]{8,}$/);
        var loz = document.getElementById("lozinka").value;
        var provjera = reg.test(loz);
        if (provjera) {
            // ispravnostLozinke = true;
            document.getElementById("lozinka").style.border = "2px";
            document.getElementById("lozinka").style.borderColor = "green";
            document.getElementById("lozinka").style.borderStyle = "solid";
        } else {
            document.getElementById("lozinka").style.border = "2px";
            document.getElementById("lozinka").style.borderColor = "red";
            document.getElementById("lozinka").style.borderStyle = "solid";


        }
    });
    var lozinka2 = document.getElementById("pon_lozinka");
    lozinka2.addEventListener("keyup", function (event) {
        if (document.getElementById("pon_lozinka").value !== document.getElementById("lozinka").value) {
            document.getElementById("pon_lozinka").style.border = "2px";
            document.getElementById("pon_lozinka").style.borderColor = "red";
            document.getElementById("pon_lozinka").style.borderStyle = "solid";
        } else {
            // jednakostLozinka = true;
            document.getElementById("pon_lozinka").style.border = "2px";
            document.getElementById("pon_lozinka").style.borderColor = "green";
            document.getElementById("pon_lozinka").style.borderStyle = "solid";
        }
    });
    var mail = document.getElementById("email");
    mail.addEventListener("keyup", function (event) {
        var reg2 = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
        var email = document.getElementById("email").value;
        var provjera2 = reg2.test(email);
        if (provjera2) {
            // valjanostEmaila = true;
            document.getElementById("email").style.border = "2px";
            document.getElementById("email").style.borderColor = "green";
            document.getElementById("email").style.borderStyle = "solid";
        } else {
            document.getElementById("email").style.border = "2px";
            document.getElementById("email").style.borderColor = "red";
            document.getElementById("email").style.borderStyle = "solid";
        }
    });
    var Ime = document.getElementById("ime");
    Ime.addEventListener("keyup", function (event) {
        var ime = document.getElementById("ime").value;
        var slovoIme = ime[0];
        var slovoVelikoIme = ime[0].toUpperCase();
        if (slovoIme === slovoVelikoIme) {
            
            document.getElementById("ime").style.border = "2px";
            document.getElementById("ime").style.borderColor = "green";
            document.getElementById("ime").style.borderStyle = "solid";
        } else {
            document.getElementById("ime").style.border = "2px";
            document.getElementById("ime").style.borderColor = "red";
            document.getElementById("ime").style.borderStyle = "solid";
        }
    });
    var Prezime = document.getElementById("prezime");
    Prezime.addEventListener("keyup", function (event) {
        var prezime = document.getElementById("prezime").value;
        var slovoPrezime = prezime[0];
        var slovoVelikoPrezime = prezime[0].toUpperCase();
        if (slovoPrezime === slovoVelikoPrezime) {
            
            document.getElementById("prezime").style.border = "2px";
            document.getElementById("prezime").style.borderColor = "green";
            document.getElementById("prezime").style.borderStyle = "solid";
        } else {
            document.getElementById("prezime").style.border = "2px";
            document.getElementById("prezime").style.borderColor = "red";
            document.getElementById("prezime").style.borderStyle = "solid";
        }
    });



    var korimeHTML = document.getElementById("korisnicko_ime");
    korimeHTML.addEventListener("focusout", function (event) {
        if (korimeHTML.value === "") {
            document.getElementById("korisnicko_ime").style.border = "2px";
            document.getElementById("korisnicko_ime").style.borderStyle = "solid";
            document.getElementById("korisnicko_ime").style.borderColor = "red";
            provjeraKorime = false;
        } else {
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    if (this.responseText === "Greška") {
                        document.getElementById("korisnicko_ime").style.border = "2px";
                        document.getElementById("korisnicko_ime").style.borderStyle = "solid";
                        document.getElementById("korisnicko_ime").style.borderColor = "red";
                        provjeraKorime = false;

                    } else {
                        document.getElementById("korisnicko_ime").style.border = "2px";
                        document.getElementById("korisnicko_ime").style.borderStyle = "solid";
                        document.getElementById("korisnicko_ime").style.borderColor = "green";
                        provjeraKorime = true;

                    }
                }
            };
            xmlhttp.open("GET", "AJAXProvjeraKorisnika.php?q=" + document.getElementById("korisnicko_ime").value, true);
            xmlhttp.send();
        }
    });

}