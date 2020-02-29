addEventListener("load", function (event) {
    kreirajDogadaje2();
});
function kreirajDogadaje2() {
    var data;
    var korisnicko_ime = new Array();
    var vrijeme_pristupa = new Array();
    var opis = new Array();
    var brojIspisanih = 0;
    var id = new Array();
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            $.each(data, function (key, value) {
                id.push(value['id']);
                korisnicko_ime.push(value['korisnicko_ime']);
                vrijeme_pristupa.push(value['vrijeme_pristupa']);
                opis.push(value['opis']);
            });
            dohvati_dnevnik();
        } else {
        }
    };
    xmlhttp.open("GET", "dohvati_dnevnik.php", true);
    xmlhttp.send();

    function dohvati_dnevnik() {
        var txt = "";
        txt += "<table>";
        for (var i = brojIspisanih; i < brojIspisanih + 5; i++) {
            txt += "<tr><td>Naziv aktivnosti: " + korisnicko_ime[i] + "</td><br>";
            txt += "<td>vrijeme_pristupa: " + vrijeme_pristupa[i] + "</td><br>";
            +"<td> opis: " + opis[i] + "</td></tr><br>";
            

        }
        txt += "</table>";
        brojIspisanih += 5;
        document.getElementById("dnevnik_lista").innerHTML = txt;
    }
    $("#prethodnaStranica").click(function (event) {
        brojIspisanih -= 10;
        dohvati_dnevnik();
    });
    $("#sljedecaStranica").click(function (event) {
        dohvati_dnevnik();
    });
    $("#prvaStranica").click(function (event) {
        brojIspisanih = 0;
        dohvati_dnevnik();
    });
    $("#zadnjaStranica").click(function (event) {
        var lista = korisnicko_ime.length % 5;
        if (lista === 0) {
            brojIspisanih = korisnicko_ime.length - 5;
        } else {
            brojIspisanih = korisnicko_ime.length - lista;
        }
        dohvati_dnevnik();
    });

    

}
