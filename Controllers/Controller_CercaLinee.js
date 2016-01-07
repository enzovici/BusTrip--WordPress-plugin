    initMapCercaLinee();
    function cercaLinee_calcolaLinea(){
    initMapCercaLinee();
    selectTipologia = document.getElementById("selectTipologiaCercaLinee");


    file=new XMLHttpRequest();
    url="/wp-content/plugins/bustrip/Models/Model_CercaLinee.php?tipologia="+selectTipologia.value;

    file.onreadystatechange=function(){
        
        if ((file.readyState == 4) && (file.status == 200)) {
        div = document.getElementById("divRisultatoCercaLinee");
        popolaTabella1(file.responseText);
        div.innerHTML = str;
        }
    }
    file.open("GET",url,true);
    file.send(null);
        
    }

    function calcolaLineaInizialeCercaLinee(){
    selectTipologia = document.getElementById("selectTipologiaCercaLinee");

    file=new XMLHttpRequest();
    url="/wp-content/plugins/bustrip/Models/Model_CercaLinee.php?tipologia="+selectTipologia.value;

    file.onreadystatechange=function(){
        
        if ((file.readyState == 4) && (file.status == 200)) {
        div = document.getElementById("divRisultatoCercaLinee");
        popolaTabella1(file.responseText);
        div.innerHTML = str;
        }
    }
    file.open("GET",url,true);
    file.send(null); 
    }

    function popolaTabella1(ris){
    righe = ris.split(';');
        n = righe.length;
        str = "<div id=\"table-wrapper\"><div id=\"table-scroll\">" +
        "<table class=\"table table-condensed table-striped\">" +
        "<thead><tr><th>Linea</th><th>Partenza</th><th>Arrivo</th></thead><tbody>";
        for(i = 0; i < n; i++){
        str += "<tr onClick=\"calcolaPercorsoCercaLinee(this)\" style=\"cursor:hand;\" onMouseOver=\"this.style.color='blue'\" onMouseOut=\"this.style.color='black'\">";
        valore = righe[i].split(',');
        m = valore.length;
        for(j = 0; j < m; j++){
            str += "<td>" + valore[j] + "</td>";
        }
        str += "</tr>";
        }
        str += "</tbody></table></div></div>";
    }

    function calcolaPercorsoCercaLinee(value){
        
        route_id=value.childNodes[0].firstChild.nodeValue;
        
        file=new XMLHttpRequest();
        url="/wp-content/plugins/bustrip/Models/Model_CercaLinee_2.php?route_id="+route_id;
        
        file.onreadystatechange=function(){
        
        if ((file.readyState == 4) && (file.status == 200)) {
        
        div = document.getElementById("divRisultatoCercaLinee2");
        
        popolaTabella2(file.responseText);
        div.innerHTML = str;
        }
    }
    file.open("GET",url,true);
    file.send(null);

    div = document.getElementById("divRisultatoCercaLinee2");
    }

    function popolaTabella2(ris){
        rc = ris.split('|');
        righe = rc[0].split(';');
        n = (righe.length)-2;
        str = "<div id=\"table-wrapper\"><div id=\"table-scroll\">" +
        "<table class=\"table table-condensed table-striped\">" +
        "<thead><tr><th>Fermata</th><th>Orario</th></thead><tbody>";
        for(i = 0; i < n; i++){
        str += "<tr>";
        valore = righe[i].split(',');
        m = valore.length;
        for(j = 0; j < m; j++){
            str += "<td>" + valore[j] + "</td>";
        }
        str += "</tr>";
        }
        str += "</tbody></table></div></div>";
        calculateAndDisplayRouteCercaLinee(rc[1]);
    }

    function initMapCercaLinee() {
        directionsDisplay = new google.maps.DirectionsRenderer;
        directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('mapCercaLinee'), {
        zoom: 14,
        center: {lat: 40.6819503, lng: 14.7646891}
        });
        directionsDisplay.setMap(map);
        
    }

    function calculateAndDisplayRouteCercaLinee(ar) {
        c = ar.split(';');
        // estrapoliamo le coordinate della prima e dell'ultima fermata
        origineLat = 0;
        origineLon = 0;
        destinazioneLat = 0;
        destinazioneLon = 0;
        n = c.length;
        ll = 0;
        for(k = 0; k < n-1; k++){
            ll = c[k].split(',');
            //console.log(ll);
            if(k == 0){
                origineLat = ll[0];
                origineLon = ll[1];
            }else if(k == n-2){
                destinazioneLat = ll[0];
                destinazioneLon = ll[1];
            }
        }

        directionsService.route({
        origin: new google.maps.LatLng(origineLat, origineLon),
        destination: new google.maps.LatLng(destinazioneLat, destinazioneLon),
        travelMode: google.maps.TravelMode.TRANSIT,
        }, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
        });
    }