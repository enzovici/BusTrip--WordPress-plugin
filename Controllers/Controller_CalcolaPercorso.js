function handler() 
{
initMap();
var partenza = document.getElementById("CalcolaPercorsoSelectPartenza").value;
var destinazione = document.getElementById("CalcolaPercorsoSelectDestinazione").value; 
var url = "/wp-content/plugins/bustrip/Models/Model_CalcolaPercorso.php?partenza="+partenza+"&destinazione="+destinazione;
file=new XMLHttpRequest();
file.onreadystatechange=function()
{
		if ((file.readyState == 4) && (file.status == 200)) 
		{
			tbody = document.getElementById("CalcolaPercorsoRisultato");
			
			 str = '';
 			 var righe =file.responseText.split(';');
 			 var n = righe.length-1;
 			 for(var i = 0; i < n; i++)
  			 {
    			var valore = righe[i].split('-');
   				str += "<tr data-value=\"" + valore[1] + "\"" + "onClick=\"calculateAndDisplayRoute($(this).data('value'))\"" + "style=\"cursor:hand;\">";
   				//str += "<tr data-value=\"" + valore[1] + "\"" + "style=\"cursor:hand;\">";
   				str += "<td>" + valore[0] + "</td>";
   				str += "<td>" + valore[2] + "</td>";
    			str += "<td>" + valore[3] + "</td>";
   				str += "</tr>";
  			 }
			
			tbody.innerHTML = str;
		}
  }
  file.open("GET",url,true);
  file.send(null);
}


function initMap() {
  directionsDisplay = new google.maps.DirectionsRenderer;
  directionsService = new google.maps.DirectionsService;
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: {lat: 40.6819503, lng: 14.7646891}
  });
  directionsDisplay.setMap(map);

}

function calculateAndDisplayRoute(cord) {
var arr = [];
    var waypts = [];
	
	var partenza = document.getElementById("CalcolaPercorsoSelectPartenza").value;
	var destinazione = document.getElementById("CalcolaPercorsoSelectDestinazione").value; 
    var url = "/wp-content/plugins/bustrip/Models/Model_CalcolaPercorso_mappa.php?trip_id="+cord+"&partenza="+partenza+"&destinazione="+destinazione;
    file=new XMLHttpRequest();
    file.onreadystatechange=function()
    {
      if ((file.readyState == 4) && (file.status == 200)) 
      {
        var wp = file.responseText.split(';');			
        var n = wp.length-1; //numero di wp
        for(var i = 0; i < n; i++)
        {
          if(i==0)
		  {
			  var part = wp[i].split('-'); 
		  }
          else if(i == n-2)
		  { 
			var dest = wp[i].split('-');
		  }
          else
          {
            arr = wp[i].split('-');
            waypts.push({
              location: new google.maps.LatLng(Number(arr[0]), Number(arr[1])),
              stopover: true
            });
          }
		}
          directionsService.route({
            origin: new google.maps.LatLng(part[0], part[1]),
            destination: new google.maps.LatLng(dest[0], dest[1]),
            waypoints: waypts,
            travelMode: google.maps.TravelMode.DRIVING
          }, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
            } else {
              window.alert('Directions request failed due to ' + status);
            }
          });
		
      }
    }
    file.open("GET",url,true);
    file.send(null);
  }

